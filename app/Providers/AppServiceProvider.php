<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\BlogPost;
use App\Observers\SlugObserver;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;

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
        if (config('features.blog')) {
            $this->loadMigrationsFrom(database_path('migrations_optional/blog'));
        }

        Service::observe(SlugObserver::class);
        Portfolio::observe(SlugObserver::class);
        if (class_exists(BlogPost::class)) {
            BlogPost::observe(SlugObserver::class);
        }
        // Rate limiting
        RateLimiter::for('contact', function (Request $request) {
            return \Illuminate\Cache\RateLimiting\Limit::perMinute(10)->by($request->ip());
        });
        RateLimiter::for('login', function (Request $request) {
            return \Illuminate\Cache\RateLimiting\Limit::perMinute(5)->by($request->ip());
        });
    }
}
