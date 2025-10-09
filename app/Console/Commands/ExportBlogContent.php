<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Stephenjude\FilamentBlog\Models\Post;
use Stephenjude\FilamentBlog\Models\Category;
use Illuminate\Support\Facades\File;

class ExportBlogContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export blog posts, categories, and tags to a JSON file for syncing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Exporting blog content...');

        // Export categories
        $categories = Category::all()->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'description' => $category->description,
                'is_visible' => $category->is_visible,
                'seo_title' => $category->seo_title,
                'seo_description' => $category->seo_description,
            ];
        });

        // Export posts with relationships
        $posts = Post::with(['category', 'tags'])->get()->map(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'sub_title' => $post->sub_title,
                'body' => $post->body,
                'blog_author_id' => $post->blog_author_id,
                'blog_category_id' => $post->blog_category_id,
                'category_slug' => $post->category?->slug,
                'published_at' => $post->published_at?->toDateTimeString(),
                'featured_image' => $post->featured_image,
                'featured_image_caption' => $post->featured_image_caption,
                'seo_title' => $post->seo_title,
                'seo_description' => $post->seo_description,
                'tags' => $post->tags->pluck('name')->toArray(),
            ];
        });

        $exportData = [
            'exported_at' => now()->toDateTimeString(),
            'categories' => $categories,
            'posts' => $posts,
        ];

        // Create storage directory if it doesn't exist
        $directory = storage_path('app/blog-sync');
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        // Save to JSON file
        $filePath = $directory . '/blog-content.json';
        File::put($filePath, json_encode($exportData, JSON_PRETTY_PRINT));

        $this->info('✅ Blog content exported successfully!');
        $this->line('📁 File: ' . $filePath);
        $this->line('📊 Categories: ' . $categories->count());
        $this->line('📝 Posts: ' . $posts->count());
        $this->newLine();
        $this->comment('Next steps:');
        $this->line('1. Commit the file: git add storage/app/blog-sync/blog-content.json');
        $this->line('2. Push to repository: git push');
        $this->line('3. On server, run: php artisan blog:sync');

        return Command::SUCCESS;
    }
}
