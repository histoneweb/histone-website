<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share latest blog posts with footer
        \Illuminate\Support\Facades\View::composer(
            'partials.footer',
            \App\View\Composers\FooterComposer::class
        );
    }
}
