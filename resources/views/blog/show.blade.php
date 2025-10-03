<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - Histone Solutions Blog</title>
    <meta name="description" content="{{ $post->excerpt }}">

    <link rel="stylesheet" href="/assets/css/variables.css">
    <link rel="stylesheet" href="/assets/css/base.css">
    <link rel="stylesheet" href="/assets/css/navigation.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link rel="stylesheet" href="/assets/css/theme.css">
    <link rel="stylesheet" href="/assets/css/blog.css">
    <link rel="stylesheet" href="/assets/css/blog-post.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    @include('partials.navigation')

    <article class="blog-post">
        <div class="container">
            <!-- Post Header -->
            <div class="post-header">
                <div class="post-breadcrumb">
                    <a href="{{ route('blog.index') }}">Blog</a>
                    <span>/</span>
                    @if($post->category)
                    <a href="{{ route('blog.category', $post->category->slug) }}">{{ $post->category->name }}</a>
                    <span>/</span>
                    @endif
                    <span>{{ $post->title }}</span>
                </div>

                @if($post->category)
                <span class="post-category">{{ $post->category->name }}</span>
                @endif

                <h1 class="post-title">{{ $post->title }}</h1>

                @if($post->excerpt)
                <p class="post-excerpt">{{ $post->excerpt }}</p>
                @endif

                <div class="post-meta">
                    @if($post->author)
                    <div class="post-author">
                        @if($post->author->photo)
                        <img src="{{ Storage::url($post->author->photo) }}" alt="{{ $post->author->name }}" class="author-avatar-large">
                        @else
                        <div class="author-avatar-large-placeholder">{{ substr($post->author->name, 0, 1) }}</div>
                        @endif
                        <div class="author-info">
                            <span class="author-name">{{ $post->author->name }}</span>
                            <div class="post-details">
                                <span class="post-date">{{ $post->published_at->format('F d, Y') }}</span>
                                @if($post->author->twitter_handle || $post->author->github_handle)
                                <span class="author-social">
                                    @if($post->author->twitter_handle)
                                    <a href="https://twitter.com/{{ $post->author->twitter_handle }}" target="_blank">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    @endif
                                    @if($post->author->github_handle)
                                    <a href="https://github.com/{{ $post->author->github_handle }}" target="_blank">
                                        <i class="fab fa-github"></i>
                                    </a>
                                    @endif
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Share Buttons -->
                    <div class="post-share">
                        <span>Share:</span>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post->slug)) }}&text={{ urlencode($post->title) }}" target="_blank" class="share-btn twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('blog.show', $post->slug)) }}" target="_blank" class="share-btn linkedin">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post->slug)) }}" target="_blank" class="share-btn facebook">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Featured Image -->
            @if($post->banner)
            <div class="post-featured-image">
                <img src="{{ Storage::url($post->banner) }}" alt="{{ $post->title }}">
            </div>
            @endif

            <!-- Post Content -->
            <div class="post-content">
                {!! $post->content !!}
            </div>

            <!-- Tags -->
            @if($post->tags && $post->tags->count() > 0)
            <div class="post-tags">
                <i class="fas fa-tags"></i>
                @foreach($post->tags as $tag)
                <span class="tag">{{ $tag->name }}</span>
                @endforeach
            </div>
            @endif

            <!-- Author Bio -->
            @if($post->author && $post->author->bio)
            <div class="author-bio">
                <div class="author-bio-avatar">
                    @if($post->author->photo)
                    <img src="{{ Storage::url($post->author->photo) }}" alt="{{ $post->author->name }}">
                    @else
                    <div class="author-avatar-bio-placeholder">{{ substr($post->author->name, 0, 1) }}</div>
                    @endif
                </div>
                <div class="author-bio-content">
                    <h3>About {{ $post->author->name }}</h3>
                    <p>{{ $post->author->bio }}</p>
                    @if($post->author->twitter_handle || $post->author->github_handle)
                    <div class="author-bio-social">
                        @if($post->author->twitter_handle)
                        <a href="https://twitter.com/{{ $post->author->twitter_handle }}" target="_blank">
                            <i class="fab fa-twitter"></i> Twitter
                        </a>
                        @endif
                        @if($post->author->github_handle)
                        <a href="https://github.com/{{ $post->author->github_handle }}" target="_blank">
                            <i class="fab fa-github"></i> GitHub
                        </a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Related Posts -->
            @if($relatedPosts->count() > 0)
            <div class="related-posts">
                <h2>Related Articles</h2>
                <div class="related-posts-grid">
                    @foreach($relatedPosts as $related)
                    <article class="related-post-card">
                        @if($related->banner)
                        <div class="related-post-image">
                            <img src="{{ Storage::url($related->banner) }}" alt="{{ $related->title }}" loading="lazy">
                        </div>
                        @endif
                        <div class="related-post-content">
                            <h3><a href="{{ route('blog.show', $related->slug) }}">{{ $related->title }}</a></h3>
                            <p>{{ Str::limit($related->excerpt, 80) }}</p>
                            <span class="related-post-date">{{ $related->published_at->format('M d, Y') }}</span>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Back to Blog -->
            <div class="back-to-blog">
                <a href="{{ route('blog.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Back to Blog
                </a>
            </div>
        </div>
    </article>

    @include('partials.footer')

    <script src="/assets/js/navigation.js"></script>
    <script src="/assets/js/theme.js"></script>
</body>
</html>
