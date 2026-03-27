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
        // Dynamically set APP_URL to match the current request's host
        // This ensures email links work for everyone on the same WiFi, even if the .env IP changes.
        if (!app()->runningInConsole()) {
            config(['app.url' => request()->getSchemeAndHttpHost()]);
        }
    }
}
