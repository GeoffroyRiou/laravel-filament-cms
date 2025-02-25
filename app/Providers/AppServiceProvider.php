<?php

namespace App\Providers;

use App\OCms\Models\Page;
use App\OCms\Models\Post;
use App\OCms\Models\Settings;
use Barryvdh\Debugbar\Facades\Debugbar;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
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

        if (!$this->app->environment('local')) {
            URL::forceScheme('https');
        }

        if (!$this->app->runningInConsole()) {
            View::share('settings', Settings::first());
            View::share('allPages', Page::published()->with('categories')->with('categories.parent')->with('categories.children')->with('categories.children.parent')->get());
        }
    }
}
