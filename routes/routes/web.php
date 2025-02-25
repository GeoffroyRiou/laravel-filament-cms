<?php

use App\OCms\Controllers\HomeController;
use App\Http\Controllers\Front\DocumentPriveController;
use App\Http\Controllers\Front\LoginController;
use App\Http\Controllers\LanguageSwitcher;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::post('/language', LanguageSwitcher::class)->name('language.switch');

/**
 * Routes protégées par l'authentification
 */
Route::group(['middleware' => 'auth'], function () {
    Route::get('/documents-prives/{file}', DocumentPriveController::class)->name('espace_parents.document.download');
});

/**
 * Création des routes  CMS
 */

foreach (getCmsControllersClasses() as $controller) {
    Route::get("/{$controller::$model::$routeSlug}s/{slug}", [$controller, 'single'])->name("{$controller::$model::$routeSlug}.single");
    Route::get("/{$controller::$model::$routeSlug}s/{parents}/{slug}", [$controller, 'singleHierarchical'])->name("{$controller::$model::$routeSlug}.single.hierarchical")->where('parents', '.*');
}
