<?php

use App\Http\Controllers\CMS\HomeController;
use App\Http\Controllers\CMS\CMSController;
use App\Http\Controllers\LanguageSwitcher;
use Illuminate\Support\Facades\Route;

Route::post('/language', LanguageSwitcher::class)->name('language.switch');

/**
 * Création des routes  CMS
 */

Route::get('/', [CMSController::class, 'home'])->name('home');
Route::get("/{cmsPath}",  CMSController::class)->name("cms")->where('cmsPath', '.*');
