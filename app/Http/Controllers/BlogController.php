<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stephenjude\FilamentBlog\Models\Post;
use Stephenjude\FilamentBlog\Models\Category;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with(['author', 'category'])
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $categories = Category::where('is_visible', true)->get();

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show($slug)
    {
        $post = Post::with(['author', 'category', 'tags'])
            ->where('slug', $slug)
            ->where('published_at', '<=', now())
            ->firstOrFail();

        $relatedPosts = Post::with(['author', 'category'])
            ->where('blog_category_id', $post->blog_category_id)
            ->where('id', '!=', $post->id)
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $posts = Post::with(['author', 'category'])
            ->where('blog_category_id', $category->id)
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $categories = Category::where('is_visible', true)->get();

        return view('blog.category', compact('posts', 'category', 'categories'));
    }
}
