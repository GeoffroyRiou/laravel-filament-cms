<?php

namespace App\OCms\Controllers;

use App\Http\Controllers\Controller;
use App\OCms\Models\Categorie;
use App\OCms\Models\Rubrique;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RubriqueController extends CategorieController
{
    public static string $model = Rubrique::class;
    protected string $view = 'categories.categorie';
}
