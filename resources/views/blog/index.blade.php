<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Histone Solutions | Web Development & Amazon SP-API Insights</title>
    <meta name="description" content="Expert insights on web development, Laravel, Amazon SP-API integration, and enterprise software solutions from Histone Solutions.">

    <link rel="stylesheet" href="/assets/css/variables.css">
    <link rel="stylesheet" href="/assets/css/base.css">
    <link rel="stylesheet" href="/assets/css/navigation.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link rel="stylesheet" href="/assets/css/theme.css">
    <link rel="stylesheet" href="/assets/css/blog.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    @include('partials.navigation')

    <!-- Blog Hero Section -->
    <section class="blog-hero">
        <div class="container">
            <h1 class="blog-hero-title">Our Blog</h1>
            <p class="blog-hero-subtitle">Expert insights on web development, Laravel, Amazon SP-API, and enterprise solutions</p>
        </div>
    </section>

    <!-- Blog Grid Section -->
    <section class="blog-section">
        <div class="container">
            <!-- Category Filter -->
            @if($categories->count() > 0)
            <div class="blog-categories">
                <a href="{{ route('blog.index') }}" class="category-pill {{ !request('category') ? 'active' : '' }}">
                    All Posts
                </a>
                @foreach($categories as $category)
                <a href="{{ route('blog.category', $category->slug) }}" class="category-pill">
                    {{ $category->name }}
                </a>
                @endforeach
            </div>
            @endif

            <!-- Blog Posts Grid -->
            <div class="blog-grid">
                @forelse($posts as $post)
                <article class="blog-card">
                    @if($post->banner)
                    <div class="blog-card-image">
                        <img src="{{ Storage::url($post->banner) }}" alt="{{ $post->title }}" loading="lazy">
                    </div>
                    @endif

                    <div class="blog-card-content">
                        <div class="blog-card-meta">
                            @if($post->category)
                            <span class="blog-category">{{ $post->category->name }}</span>
                            @endif
                            <span class="blog-date">{{ $post->published_at->format('M d, Y') }}</span>
                        </div>

                        <h2 class="blog-card-title">
                            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                        </h2>

                        @if($post->excerpt)
                        <p class="blog-card-excerpt">{{ Str::limit($post->excerpt, 120) }}</p>
                        @endif

                        <div class="blog-card-footer">
                            @if($post->author)
                            <div class="blog-author">
                                @if($post->author->photo)
                                <img src="{{ Storage::url($post->author->photo) }}" alt="{{ $post->author->name }}" class="author-avatar">
                                @else
                                <div class="author-avatar-placeholder">{{ substr($post->author->name, 0, 1) }}</div>
                                @endif
                                <span class="author-name">{{ $post->author->name }}</span>
                            </div>
                            @endif

                            <a href="{{ route('blog.show', $post->slug) }}" class="read-more">
                                Read More <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </article>
                @empty
                <div class="no-posts">
                    <i class="fas fa-file-alt"></i>
                    <p>No blog posts available yet. Check back soon!</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($posts->hasPages())
            <div class="blog-pagination">
                {{ $posts->links() }}
            </div>
            @endif
        </div>
    </section>

    @include('partials.footer')

    <script src="/assets/js/navigation.js"></script>
    <script src="/assets/js/theme.js"></script>
</body>
</html>
