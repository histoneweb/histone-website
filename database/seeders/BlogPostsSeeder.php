<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Stephenjude\FilamentBlog\Models\Post;
use Stephenjude\FilamentBlog\Models\Category;
use Stephenjude\FilamentBlog\Models\Author;
use App\Models\User;

class BlogPostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create admin user
        $user = User::first();

        // Get or create author profile for the user
        $author = Author::firstOrCreate(
            ['email' => $user->email],
            [
                'name' => $user->name,
                'photo' => null,
                'bio' => 'Senior Full Stack Developer specializing in enterprise solutions, Amazon SP-API integrations, and scalable web applications.',
                'github_handle' => 'histone-solutions',
                'twitter_handle' => 'histone_dev',
            ]
        );

        // Get or create categories
        $categories = [
            Category::firstOrCreate(
                ['slug' => 'amazon-sp-api'],
                [
                    'name' => 'Amazon SP-API',
                    'description' => 'Everything about Amazon Seller Partner API integration and development',
                    'is_visible' => true,
                ]
            ),
            Category::firstOrCreate(
                ['slug' => 'laravel-development'],
                [
                    'name' => 'Laravel Development',
                    'description' => 'Laravel tips, tricks, and best practices for modern web development',
                    'is_visible' => true,
                ]
            ),
            Category::firstOrCreate(
                ['slug' => 'web-development'],
                [
                    'name' => 'Web Development',
                    'description' => 'General web development insights and tutorials',
                    'is_visible' => true,
                ]
            ),
        ];

        // Blog Post 1: Amazon SP-API Migration Guide
        Post::create([
            'blog_author_id' => $author->id,
            'blog_category_id' => $categories[0]->id,
            'title' => 'Complete Guide to Amazon SP-API Migration: From MWS to Modern Integration',
            'slug' => 'complete-guide-amazon-sp-api-migration',
            'excerpt' => 'Step-by-step guide for sellers transitioning from Amazon MWS to SP-API',
            'content' => '<h2>Why Migrate to Amazon SP-API?</h2>
<p>Amazon MWS (Marketplace Web Service) is being deprecated, making the migration to SP-API (Seller Partner API) essential for all Amazon sellers and developers. The SP-API offers improved security, better performance, and enhanced features that modernize how you interact with Amazon\'s marketplace.</p>

<h2>Key Differences Between MWS and SP-API</h2>
<p><strong>1. Authentication:</strong> SP-API uses OAuth 2.0 with LWA (Login with Amazon) instead of legacy signature-based authentication, providing better security and easier implementation.</p>

<p><strong>2. REST Architecture:</strong> Unlike MWS\'s XML-based approach, SP-API uses modern RESTful JSON APIs, making integration cleaner and more efficient.</p>

<p><strong>3. Granular Permissions:</strong> SP-API offers role-based access control, allowing you to request only the permissions your application needs.</p>

<h2>Migration Steps</h2>
<p><strong>Step 1: Register Your Application</strong><br>
Register your application in Seller Central and obtain your LWA credentials (Client ID and Client Secret).</p>

<p><strong>Step 2: Implement OAuth 2.0</strong><br>
Replace your MWS signature authentication with OAuth 2.0 token-based authentication using AWS Signature Version 4.</p>

<p><strong>Step 3: Update API Endpoints</strong><br>
Map your existing MWS operations to their SP-API equivalents. For example, GetOrders in MWS becomes the Orders API in SP-API.</p>

<p><strong>Step 4: Handle Rate Limiting</strong><br>
SP-API has different rate limits than MWS. Implement proper retry logic and respect the rate limit headers in API responses.</p>

<h2>Common Challenges and Solutions</h2>
<p><strong>Token Refresh:</strong> Access tokens expire after 1 hour. Implement automatic refresh token handling to maintain uninterrupted service.</p>

<p><strong>Restricted Data:</strong> PII (Personally Identifiable Information) requires additional RDT (Restricted Data Token) requests. Plan your data access patterns accordingly.</p>

<p><strong>Regional Endpoints:</strong> SP-API requires region-specific endpoints. Ensure your application handles multi-region operations correctly.</p>

<h2>Best Practices</h2>
<ul>
<li>Always use refresh tokens to obtain new access tokens before they expire</li>
<li>Implement comprehensive error handling for all API calls</li>
<li>Use webhooks (Event Bridge) for real-time order updates instead of polling</li>
<li>Cache RDT tokens to minimize API calls for restricted data</li>
<li>Monitor rate limits and implement exponential backoff for retries</li>
</ul>

<h2>Conclusion</h2>
<p>Migrating from MWS to SP-API is not just a technical upgrade—it\'s an investment in your Amazon integration\'s future. The improved security, performance, and features make the migration effort worthwhile. Start planning your migration today to ensure uninterrupted service for your Amazon operations.</p>',
            'published_at' => now()->subDays(7),
        ]);

        // Blog Post 2: Laravel Performance Optimization
        Post::create([
            'blog_author_id' => $author->id,
            'blog_category_id' => $categories[1]->id,
            'title' => '10 Laravel Performance Optimization Techniques for Enterprise Applications',
            'slug' => 'laravel-performance-optimization-techniques',
            'excerpt' => 'Boost your Laravel application speed with these proven optimization strategies',
            'content' => '<h2>Introduction</h2>
<p>Laravel is a powerful framework, but without proper optimization, even the best-coded applications can suffer from performance issues. In enterprise environments where scale matters, these optimizations become critical.</p>

<h2>1. Database Query Optimization</h2>
<p><strong>Eager Loading:</strong> Always use eager loading to prevent N+1 query problems. Instead of lazy loading relationships, use <code>with()</code> to load them upfront.</p>

<pre><code>// Bad - N+1 queries
$posts = Post::all();
foreach($posts as $post) {
    echo $post->author->name;
}

// Good - 2 queries only
$posts = Post::with(\'author\')->get();</code></pre>

<h2>2. Cache Strategic Data</h2>
<p>Implement multi-layer caching: query results, view fragments, and full-page caching where appropriate. Use Redis or Memcached for distributed caching in load-balanced environments.</p>

<pre><code>// Cache database queries
$users = Cache::remember(\'active-users\', 3600, function() {
    return User::where(\'active\', true)->get();
});</code></pre>

<h2>3. Optimize Composer Autoloader</h2>
<p>Generate optimized class maps in production to reduce file system lookups:</p>

<pre><code>composer install --optimize-autoloader --no-dev</code></pre>

<h2>4. Use Queue Workers for Heavy Tasks</h2>
<p>Offload time-consuming operations like email sending, image processing, and API calls to queue workers. This keeps your request-response cycle fast.</p>

<h2>5. Implement Database Indexing</h2>
<p>Add indexes to frequently queried columns, especially foreign keys and columns used in WHERE clauses. Monitor slow query logs to identify optimization opportunities.</p>

<h2>6. Enable OPcache</h2>
<p>PHP OPcache stores precompiled script bytecode in memory, dramatically reducing script execution time. Ensure it\'s enabled in production.</p>

<h2>7. Optimize Configuration Loading</h2>
<p>Cache all configuration files in production:</p>

<pre><code>php artisan config:cache
php artisan route:cache
php artisan view:cache</code></pre>

<h2>8. Use CDN for Static Assets</h2>
<p>Serve CSS, JavaScript, and images from a CDN to reduce server load and improve page load times globally.</p>

<h2>9. Implement HTTP Caching</h2>
<p>Use ETags and browser caching headers to reduce redundant requests. Laravel makes this easy with response macros.</p>

<h2>10. Monitor and Profile</h2>
<p>Use tools like Laravel Telescope, Debugbar, and New Relic to identify bottlenecks. Regular monitoring helps catch performance issues before they impact users.</p>

<h2>Conclusion</h2>
<p>Performance optimization is an ongoing process. Start with these techniques, measure the impact, and continuously refine. A well-optimized Laravel application can handle millions of requests while maintaining sub-second response times.</p>',
            'published_at' => now()->subDays(3),
        ]);

        // Blog Post 3: Modern Web Development Stack
        Post::create([
            'blog_author_id' => $author->id,
            'blog_category_id' => $categories[2]->id,
            'title' => 'Building Modern Web Applications: The 2025 Tech Stack Guide',
            'slug' => 'modern-web-development-stack-2025',
            'excerpt' => 'Choose the right technologies for your next web application project',
            'content' => '<h2>The Evolution of Web Development</h2>
<p>The web development landscape in 2025 is more diverse and powerful than ever. Choosing the right tech stack can make or break your project\'s success. Let\'s explore the modern approach to building scalable web applications.</p>

<h2>Backend: Laravel + PHP 8.3</h2>
<p>Laravel remains the king of PHP frameworks, offering an elegant syntax, robust ecosystem, and enterprise-ready features. PHP 8.3 brings JIT compilation, making it faster than ever.</p>

<p><strong>Why Laravel?</strong></p>
<ul>
<li>Mature ecosystem with packages for everything</li>
<li>Built-in authentication, authorization, and API support</li>
<li>Excellent documentation and community</li>
<li>Seamless integration with modern frontend frameworks</li>
</ul>

<h2>Frontend: Modern JavaScript Frameworks</h2>
<p><strong>For Interactive UIs:</strong> React, Vue 3, or Svelte for component-based development with reactive state management.</p>

<p><strong>For Server-Side Rendering:</strong> Next.js, Nuxt 3, or Inertia.js for improved SEO and initial page load performance.</p>

<p><strong>For Admin Panels:</strong> Filament PHP provides a beautiful admin interface with zero JavaScript needed.</p>

<h2>Database: PostgreSQL or MySQL 8</h2>
<p>PostgreSQL excels at complex queries and JSON operations, while MySQL 8 offers excellent performance for traditional relational data. Both support horizontal scaling with read replicas.</p>

<h2>Caching: Redis</h2>
<p>Redis is essential for session management, queue processing, and data caching. Its versatility makes it a must-have in any modern stack.</p>

<h2>Search: Elasticsearch or MeiliSearch</h2>
<p>Full-text search capabilities are crucial. MeiliSearch offers simpler setup for smaller projects, while Elasticsearch provides enterprise-grade search with advanced features.</p>

<h2>DevOps: Docker + CI/CD</h2>
<p>Containerization with Docker ensures consistency across environments. GitHub Actions or GitLab CI automates testing and deployment.</p>

<pre><code>version: \'3.8\'
services:
  app:
    image: php:8.3-fpm
    volumes:
      - ./:/var/www
  nginx:
    image: nginx:alpine
    ports:
      - "80:80"
  redis:
    image: redis:alpine
  mysql:
    image: mysql:8</code></pre>

<h2>Monitoring: Laravel Pulse + Sentry</h2>
<p>Real-time application monitoring with Laravel Pulse catches performance issues, while Sentry tracks errors and exceptions in production.</p>

<h2>The Complete Stack</h2>
<p><strong>Backend:</strong> Laravel 11 + PHP 8.3<br>
<strong>Frontend:</strong> Inertia.js + Vue 3 or Livewire<br>
<strong>Database:</strong> PostgreSQL 16<br>
<strong>Cache:</strong> Redis 7<br>
<strong>Search:</strong> MeiliSearch<br>
<strong>Queue:</strong> Redis + Horizon<br>
<strong>Deployment:</strong> Docker + Laravel Forge/Vapor<br>
<strong>Monitoring:</strong> Pulse + Sentry</p>

<h2>Making the Right Choice</h2>
<p>Your tech stack should align with your team\'s expertise, project requirements, and scalability needs. Start with battle-tested technologies and introduce new tools gradually as your application grows.</p>

<h2>Conclusion</h2>
<p>The modern web development stack balances performance, developer experience, and maintainability. Focus on proven technologies that solve real problems rather than chasing trends. Build with the future in mind, but deploy with today\'s best practices.</p>',
            'published_at' => now()->subDay(),
        ]);
    }
}
