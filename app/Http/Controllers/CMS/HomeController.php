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
