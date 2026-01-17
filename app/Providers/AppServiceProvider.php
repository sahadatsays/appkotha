<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
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
