<?php

use App\Http\Controllers\CMS\HomeController;
use App\Http\Controllers\LanguageSwitcher;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::post('/language', LanguageSwitcher::class)->name('language.switch');

/**
 * Création des routes  CMS
 */

foreach (getCmsControllersClasses() as $controller) {
    Route::get("/{$controller::$model::$routeSlug}s/{slug}", [$controller, 'single'])->name("{$controller::$model::$routeSlug}.single");
    Route::get("/{$controller::$model::$routeSlug}s/{parents}/{slug}", [$controller, 'singleHierarchical'])->name("{$controller::$model::$routeSlug}.single.hierarchical")->where('parents', '.*');
}
