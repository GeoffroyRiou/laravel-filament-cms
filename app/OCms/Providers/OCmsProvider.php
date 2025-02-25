<?php

namespace App\Ocms\Providers;

use App\OCms\Components\PageBuilder;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class OCmsProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void {}

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::anonymousComponentPath(resource_path('views/ocms/components/blocks'), 'ocms-blocks');
        Blade::anonymousComponentPath(resource_path('views/ocms/components'), 'ocms');
        Blade::component('ocms::page-builder', PageBuilder::class);
    }
}
