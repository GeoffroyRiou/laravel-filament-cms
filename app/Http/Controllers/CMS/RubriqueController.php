<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Rubrique;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RubriqueController extends CategorieController
{
    public static string $model = Rubrique::class;
    protected string $view = 'categories.categorie';
}
