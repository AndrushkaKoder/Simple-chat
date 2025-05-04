<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Inertia::share('appName', config('app.name'));
    }

    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
