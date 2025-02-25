<?php

namespace App\OCms\Controllers;

use App\OCms\Models\Accueil;
use App\OCms\Models\Reference;
use App\OCms\Models\Temoignage;

class HomeController extends PostController
{
    public static string $model = Accueil::class;


    public function __invoke()
    {
        $view = $this->single('accueil');

        if (!$this->post) {
            return "La page d'accueil n'a pas été créée dans le panneau d'administration";
        }

        return $view;
    }

    protected function getOtherViewData(): array
    {
        return [];
    }
}
