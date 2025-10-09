<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Stephenjude\FilamentBlog\Models\Post;
use Stephenjude\FilamentBlog\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Stephenjude\FilamentBlog\Models\Author;

class SyncBlogContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:sync {--force : Force sync without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import and sync blog posts from exported JSON file (updates existing, creates new)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = storage_path('app/blog-sync/blog-content.json');

        if (!File::exists($filePath)) {
            $this->error('❌ Blog content file not found at: ' . $filePath);
            $this->comment('Run "php artisan blog:export" on local first, then commit and push the file.');
            return Command::FAILURE;
        }

        $data = json_decode(File::get($filePath), true);

        if (!$data) {
            $this->error('❌ Invalid JSON file format.');
            return Command::FAILURE;
        }

        $this->info('📦 Blog content file found!');
        $this->line('📅 Exported at: ' . $data['exported_at']);
        $this->line('👤 Authors: ' . count($data['authors'] ?? []));
        $this->line('📊 Categories: ' . count($data['categories']));
        $this->line('📝 Posts: ' . count($data['posts']));
        $this->newLine();

        if (!$this->option('force') && !$this->confirm('Do you want to proceed with syncing?', true)) {
            $this->comment('Sync cancelled.');
            return Command::SUCCESS;
        }

        DB::beginTransaction();

        try {
            // Sync Categories
            $this->info('Syncing categories...');
            $categoriesCreated = 0;
            $categoriesUpdated = 0;
            $categoryMap = [];

            foreach ($data['categories'] as $categoryData) {
                $category = Category::updateOrCreate(
                    ['slug' => $categoryData['slug']],
                    [
                        'name' => $categoryData['name'],
                        'description' => $categoryData['description'],
                        'is_visible' => $categoryData['is_visible'],
                        'seo_title' => $categoryData['seo_title'],
                        'seo_description' => $categoryData['seo_description'],
                    ]
                );

                $categoryMap[$categoryData['id']] = $category->id;

                if ($category->wasRecentlyCreated) {
                    $categoriesCreated++;
                } else {
                    $categoriesUpdated++;
                }
            }

            $this->line("✅ Categories: {$categoriesCreated} created, {$categoriesUpdated} updated");

            // Get or create default author for posts
            $defaultAuthor = Author::first();
            if (!$defaultAuthor) {
                $this->error('❌ No blog authors found. Please create at least one author first.');
                DB::rollBack();
                return Command::FAILURE;
            }
            $this->line("ℹ️  Using default author: {$defaultAuthor->name} (ID: {$defaultAuthor->id})");

            // Sync Posts
            $this->info('Syncing posts...');
            $postsCreated = 0;
            $postsUpdated = 0;

            foreach ($data['posts'] as $postData) {
                // Map old category ID to new category ID
                $newCategoryId = $categoryMap[$postData['blog_category_id']] ?? null;

                // Check if author exists on server, otherwise use default
                $authorExists = Author::find($postData['blog_author_id']);
                $authorId = $authorExists ? $postData['blog_author_id'] : $defaultAuthor->id;

                $post = Post::updateOrCreate(
                    ['slug' => $postData['slug']],
                    [
                        'title' => $postData['title'],
                        'excerpt' => $postData['excerpt'] ?? '',
                        'content' => $postData['content'] ?? '',
                        'blog_author_id' => $authorId,
                        'blog_category_id' => $newCategoryId,
                        'published_at' => $postData['published_at'],
                        'banner' => $postData['banner'] ?? null,
                    ]
                );

                // Sync tags
                if (!empty($postData['tags'])) {
                    $tagIds = [];
                    foreach ($postData['tags'] as $tagName) {
                        $tag = DB::table('blog_post_tags')->where('name', $tagName)->first();
                        if (!$tag) {
                            $tagId = DB::table('blog_post_tags')->insertGetId([
                                'name' => $tagName,
                                'slug' => \Illuminate\Support\Str::slug($tagName),
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                            $tagIds[] = $tagId;
                        } else {
                            $tagIds[] = $tag->id;
                        }
                    }
                    $post->tags()->sync($tagIds);
                }

                if ($post->wasRecentlyCreated) {
                    $postsCreated++;
                } else {
                    $postsUpdated++;
                }
            }

            $this->line("✅ Posts: {$postsCreated} created, {$postsUpdated} updated");

            DB::commit();

            $this->newLine();
            $this->info('🎉 Blog content synced successfully!');
            $this->comment('Run "php artisan sitemap:generate" to update the sitemap.');

            return Command::SUCCESS;

        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('❌ Sync failed: ' . $e->getMessage());
            $this->line($e->getTraceAsString());
            return Command::FAILURE;
        }
    }
}
