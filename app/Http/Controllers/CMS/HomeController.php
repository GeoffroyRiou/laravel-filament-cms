<?php

namespace App\Http\Controllers\CMS;

use App\Models\Accueil;
use App\Models\Reference;
use App\Models\Temoignage;

class HomeController extends PostController
{
    public static string $model = Accueil::class;
    protected string $view = 'pages.accueil';


    public function __invoke()
    {
        $accueil = Accueil::first();

        if (!$accueil) {
            return "La page d'accueil n'a pas été créée dans le panneau d'administration";
        }

        return $this->single('accueil');
    }

    protected function getOtherViewData(): array
    {
        return [];
    }
}
