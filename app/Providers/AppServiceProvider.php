<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\Post;
use App\Models\Settings;
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

        FilamentAsset::register([
            Css::make('media-library', __DIR__ . '/../../resources/filament/css/media-library.css'),
        ]);

        if (!$this->app->environment('local')) {
            URL::forceScheme('https');
        }

        if (!$this->app->runningInConsole()) {
            View::share('settings', Settings::first());
            View::share('allPages', Page::published()->with('categories')->with('categories.parent')->with('categories.children')->with('categories.children.parent')->get());
        }
    }
}
