<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
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
        // Security: Force HTTPS in production
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        // Security: Disable debug mode in production
        if (app()->environment('production')) {
            config(['app.debug' => false]);
        }

        // Security: Prevent debug mode if explicitly set in env
        if (config('app.debug') && app()->environment('production')) {
            \Log::warning('Debug mode is enabled in production! This is a security risk.');
            config(['app.debug' => false]);
        }

        // Share settings with all views
        View::composer('*', function ($view) {
            static $siteSettings = null;

            if ($siteSettings === null && Schema::hasTable('settings')) {
                try {
                    $siteSettings = [
                        'company' => Setting::getGroup('company'),
                        'hero' => Setting::getGroup('hero'),
                        'colors' => Setting::getGroup('colors'),
                        'social' => Setting::getGroup('social'),
                        'contact' => Setting::getGroup('contact'),
                        'stats' => Setting::getGroup('stats'),
                    ];
                } catch (\Exception $e) {
                    $siteSettings = [];
                }
            }

            $view->with('siteSettings', $siteSettings ?? []);
        });
    }
}
