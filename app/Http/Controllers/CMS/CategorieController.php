<?php

namespace App\Http\Controllers\CMS;

use Illuminate\View\View;

class CategorieController
{
    protected string $view = 'categories.categorie';

    public function show($categorie): View{
        $view = getViewNameFromSlug($categorie->slug) ?? $this->view;

        return view($view, array_merge(
            compact('categorie'),
            $this->getOtherViewData()
        ));
    }

    /**
     * Permet d'injecter des données supplémentaires à la vue
     */
    protected function getOtherViewData(): array
    {
        return [];
    }
}
