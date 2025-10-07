<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Stephenjude\FilamentBlog\Models\Post;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate the sitemap for the website';

    public function handle()
    {
        $this->info('Generating sitemap...');

        $sitemap = Sitemap::create();

        // Add home page
        $sitemap->add(
            Url::create('/')
                ->setLastModificationDate(now())
                ->setPriority(1.0)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
        );

        // Add blog index
        $sitemap->add(
            Url::create('/blog')
                ->setLastModificationDate(now())
                ->setPriority(0.9)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
        );

        // Add all published blog posts
        Post::where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->each(function (Post $post) use ($sitemap) {
                $sitemap->add(
                    Url::create("/blog/{$post->slug}")
                        ->setLastModificationDate($post->updated_at)
                        ->setPriority(0.8)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                );
            });

        // Add legal pages
        $sitemap->add(
            Url::create('/privacy-policy')
                ->setLastModificationDate(now())
                ->setPriority(0.5)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
        );

        $sitemap->add(
            Url::create('/terms-of-service')
                ->setLastModificationDate(now())
                ->setPriority(0.5)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
        );

        $sitemap->add(
            Url::create('/cookie-policy')
                ->setLastModificationDate(now())
                ->setPriority(0.5)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
        );

        // Write to public directory
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully at public/sitemap.xml');

        return Command::SUCCESS;
    }
}
