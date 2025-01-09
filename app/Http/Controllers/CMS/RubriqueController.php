<?php

namespace App\Http\Controllers\CMS;

class RubriqueController extends CategorieController
{
    protected string $view = 'categories.rubrique';

    protected function getOtherViewData(): array
    {
        return ['demo' => 'valeur demo'];
    }
}
