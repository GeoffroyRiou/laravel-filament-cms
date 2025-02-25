<?php

namespace App\OCms\Controllers;

use App\Http\Controllers\Controller;
use App\OCms\Models\Categorie;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategorieController extends Controller
{
    public static string $model = Categorie::class;
    protected string $view = 'categories.categorie';

    public function single(string $slug): View
    {
        return $this->getCategoriePage($slug);
    }

    public function singleHierarchical(string $parents, string $slug): View
    {
        return $this->getCategoriePage($slug);
    }

    /**
     * Récupère le Categorie et retourne sa vue
     */
    private function getCategoriePage(string $slug): View
    {
        $categorie = $this->getCategorie(static::$model, $slug);

        return view($this->view, compact('categorie'));
    }

    /**
     * Récupère une catégorie à partir de sa classe et de son slug
     * Si pas de contenu pour la langue courante, redirection en home
     */
    protected function getCategorie(string $classPath, string $slug): Categorie|RedirectResponse
    {
        return $classPath::where('model', $classPath)->where('slug->' . app()->getLocale(), $slug)->firstOrFail();
    }
}
