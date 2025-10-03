<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactSubmissionResource\Pages;
use App\Filament\Resources\ContactSubmissionResource\RelationManagers;
use App\Mail\ContactReply as ContactReplyMail;
use App\Models\ContactReply;
use App\Models\ContactSubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Mail;

class ContactSubmissionResource extends Resource
{
    protected static ?string $model = ContactSubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationLabel = 'Contact Inquiries';

    protected static ?string $modelLabel = 'Contact Inquiry';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'Communication';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::whereNull('read_at')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::whereNull('read_at')->count() > 0 ? 'warning' : 'primary';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Contact Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->disabled(),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->disabled(),
                        Forms\Components\TextInput::make('company')
                            ->maxLength(255)
                            ->disabled(),
                        Forms\Components\TextInput::make('service')
                            ->maxLength(255)
                            ->disabled(),
                        Forms\Components\Textarea::make('message')
                            ->required()
                            ->columnSpanFull()
                            ->rows(5)
                            ->disabled(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Status & Notes')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->required()
                            ->options([
                                'new' => 'New',
                                'contacted' => 'Contacted',
                                'converted' => 'Converted',
                                'closed' => 'Closed',
                            ])
                            ->default('new'),
                        Forms\Components\Textarea::make('notes')
                            ->columnSpanFull()
                            ->rows(4)
                            ->placeholder('Add internal notes about this inquiry...'),
                    ]),

                Forms\Components\Section::make('Reply History')
                    ->schema([
                        Forms\Components\Repeater::make('replies')
                            ->relationship('replies')
                            ->schema([
                                Forms\Components\TextInput::make('subject')
                                    ->disabled()
                                    ->columnSpanFull(),
                                Forms\Components\Textarea::make('message')
                                    ->disabled()
                                    ->rows(3)
                                    ->columnSpanFull(),
                                Forms\Components\Placeholder::make('sent_info')
                                    ->label('Sent')
                                    ->content(fn (ContactReply $record) =>
                                        $record->sent_at?->format('M d, Y H:i') . ' by ' . ($record->user?->name ?? 'System')
                                    ),
                            ])
                            ->columns(2)
                            ->addable(false)
                            ->deletable(false)
                            ->reorderable(false)
                            ->defaultItems(0)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['subject'] ?? null)
                    ])
                    ->collapsed()
                    ->hidden(fn ($record) => !$record || $record->replies()->count() === 0),

                Forms\Components\Section::make('Metadata')
                    ->schema([
                        Forms\Components\TextInput::make('ip_address')
                            ->label('IP Address')
                            ->maxLength(255)
                            ->disabled(),
                        Forms\Components\DateTimePicker::make('read_at')
                            ->label('Read At')
                            ->disabled(),
                        Forms\Components\DateTimePicker::make('created_at')
                            ->label('Submitted At')
                            ->disabled(),
                    ])
                    ->columns(3)
                    ->collapsible()
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('read_at')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-envelope-open')
                    ->falseIcon('heroicon-o-envelope')
                    ->trueColor('success')
                    ->falseColor('warning')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('company')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('service')
                    ->searchable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Web Development' => 'info',
                        'Amazon SP-API Integration' => 'warning',
                        'E-Commerce Solutions' => 'success',
                        default => 'gray',
                    }),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'new',
                        'info' => 'contacted',
                        'success' => 'converted',
                        'danger' => 'closed',
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Submitted')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->since(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'contacted' => 'Contacted',
                        'converted' => 'Converted',
                        'closed' => 'Closed',
                    ]),
                Tables\Filters\Filter::make('unread')
                    ->query(fn (Builder $query): Builder => $query->whereNull('read_at'))
                    ->label('Unread Only'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('reply')
                    ->label('Send Reply')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('primary')
                    ->form([
                        Forms\Components\Section::make('Customer Inquiry')
                            ->schema([
                                Forms\Components\Placeholder::make('customer_info')
                                    ->label('Customer Details')
                                    ->content(fn (ContactSubmission $record) =>
                                        "**Name:** {$record->name}  \n" .
                                        "**Email:** {$record->email}  \n" .
                                        ($record->company ? "**Company:** {$record->company}  \n" : '') .
                                        ($record->service ? "**Service:** {$record->service}  \n" : '') .
                                        "**Submitted:** {$record->created_at->format('M d, Y H:i')}"
                                    ),
                                Forms\Components\Placeholder::make('inquiry_message')
                                    ->label('Original Message')
                                    ->content(fn (ContactSubmission $record) => strip_tags($record->message)),
                            ])
                            ->collapsible()
                            ->collapsed(false),

                        Forms\Components\Section::make('Your Reply')
                            ->schema([
                                Forms\Components\TextInput::make('subject')
                                    ->label('Subject')
                                    ->default(fn (ContactSubmission $record) => "Re: Your inquiry about {$record->service}")
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('message')
                                    ->label('Reply Message')
                                    ->required()
                                    ->rows(8)
                                    ->placeholder('Write your reply here...')
                                    ->helperText('This message will be sent to the customer\'s email address.'),
                            ])
                    ])
                    ->action(function (ContactSubmission $record, array $data): void {
                        try {
                            // Send email
                            Mail::to($record->email)->send(
                                new ContactReplyMail($record, $data['message'], $data['subject'])
                            );

                            // Save reply to database
                            ContactReply::create([
                                'contact_submission_id' => $record->id,
                                'subject' => $data['subject'],
                                'message' => $data['message'],
                                'user_id' => auth()->id(),
                                'sent' => true,
                                'sent_at' => now(),
                            ]);

                            // Mark as contacted
                            $record->update(['status' => 'contacted']);

                            Notification::make()
                                ->title('Reply sent successfully')
                                ->success()
                                ->body("Your reply has been sent to {$record->email}")
                                ->send();
                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('Failed to send reply')
                                ->danger()
                                ->body('Error: ' . $e->getMessage())
                                ->send();
                        }
                    }),
                Tables\Actions\Action::make('markAsRead')
                    ->label('Mark as Read')
                    ->icon('heroicon-o-envelope-open')
                    ->color('success')
                    ->hidden(fn (ContactSubmission $record) => $record->read_at !== null)
                    ->action(fn (ContactSubmission $record) => $record->markAsRead()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('markAsRead')
                        ->label('Mark as Read')
                        ->icon('heroicon-o-envelope-open')
                        ->action(fn ($records) => $records->each->markAsRead()),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactSubmissions::route('/'),
            'create' => Pages\CreateContactSubmission::route('/create'),
            'edit' => Pages\EditContactSubmission::route('/{record}/edit'),
        ];
    }
}
