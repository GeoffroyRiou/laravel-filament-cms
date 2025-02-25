<?php

namespace App\OCms\Controllers;

use App\OCms\Models\Page;
use App\OCms\Models\Reference;
use App\OCms\Models\Rubrique;

class PageController extends PostController
{
    public static string $model = Page::class;

    /**
     * Permet d'injecter des données supplémentaires à la vue
     */
    protected function getOtherViewData(): array
    {
        return [];
    }
}
