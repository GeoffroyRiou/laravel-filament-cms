<?php

namespace App\Http\Controllers\CMS;

use Illuminate\View\View;

class PostController
{
    protected string $view = 'pages.article';

    public function show($post): View
    {
        $view = getViewNameFromSlug($post->slug) ?? $this->view;

        return view($view, array_merge(
            compact('post'),
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
