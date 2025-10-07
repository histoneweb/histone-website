<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Stephenjude\FilamentBlog\Models\Post;

class FooterComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $latestPosts = Post::with(['category'])
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->limit(4)
            ->get();

        $view->with('latestPosts', $latestPosts);
    }
}
