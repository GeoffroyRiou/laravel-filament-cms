<?php

namespace App\Http\Controllers\CMS;

use App\Models\Page;
use App\Models\Reference;
use App\Models\Rubrique;

class PageController extends PostController
{
    public static string $model = Page::class;
    protected string $view = 'pages.page';

    /**
     * Permet d'injecter des données supplémentaires à la vue
     */
    protected function getOtherViewData(): array
    {
        if($this->slug === 'nos-realisations'){
            return [
                'rubriques' => Rubrique::all()
            ];
        }
        return [];
    }
}
