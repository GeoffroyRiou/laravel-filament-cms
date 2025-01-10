<?php

namespace App\Providers;

use App\Models\Expertise;
use App\Models\Settings;
use Barryvdh\Debugbar\Facades\Debugbar;
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
        
        Debugbar::disable();
        try {
            View::share('settings', Settings::first());
            View::share('expertises', Expertise::published()->orderby('order', 'asc')->get());
        } catch (\Exception $e) {
        }
    }
}
