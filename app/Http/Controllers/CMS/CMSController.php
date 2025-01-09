<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Accueil;
use App\Models\Categorie;
use App\Models\Post;

class CMSController extends Controller
{
    private string $controllersBaseNamespace = 'App\\Http\\Controllers\\CMS\\';

    /**
     * Cherche dans les posts ou catégories à partir du slug.
     * S'il existe appelle le controller spécifique au modèle du post ou de la catégorie.
     * Sinon , controller par défaut
     * Si pas de post ni de catégorie, 404
     *
     * @param  string|null  $modelName  The name of the model.
     * @return string|null The controller name if found, otherwise null.
     */
    public function __invoke(string $path)
    {

        $pathParts = explode('/', $path);
        $slug = $pathParts[array_key_last($pathParts)];

        $controllerClass = false;
        $inferedControllerName = false;
        $defaultController = false;

        // On tente de récupérer un post
        $post = Post::withoutGlobalScopes()->where('slug->' . app()->getLocale(), $slug)->first();
        if ($post) {
            // Initialisation avec le obn modèle. On fait une autre requète pour avoir les bonnes relations
            $post = $post->model::where('slug->' . app()->getLocale(), $post->slug)->first();
            $defaultController = PostController::class;

            // Pas de post, on essaie pour les catégories
        } else {
            $categorie = Categorie::withoutGlobalScopes()->where('slug->' . app()->getLocale(), $slug)->first();
            if ($categorie) {
                // Initialisation avec le obn modèle. On fait une autre requète pour avoir les bonnes relations
                $categorie = $categorie->model::where('slug->' . app()->getLocale(), $categorie->slug)->first();
                $defaultController = CategorieController::class;
            }
        }

        $cmsContent = $post ?? $categorie ?? null;

        // On tente de trouver un controller
        $inferedControllerName = $this->getControllerNameFromModel($cmsContent->model ?? null);
        $controllerClass = $inferedControllerName ? $inferedControllerName : $defaultController;

        // Controller trouvé, on appelle la méthode d'affichage
        if ($cmsContent && $controllerClass) {
            $finalController = new $controllerClass;

            return $finalController->show($cmsContent);

            // Controller non trouvé on crash car c'est un cas non autorisé
        } elseif ($cmsContent && ! $controllerClass) {
            throw new \Exception("Pas de controller trouvé pour le slug $slug", 1);
        }

        // Page non trouvée
        abort(404);
    }

    /**
     * Cas spécial pour la home
     * Au final même mécanique d'appel de controller
     */
    public function home()
    {
        $accueil = Accueil::first();
        if (! $accueil) {
            return "La page d'accueil n'a pas été créée dans le panneau d'administration";
        }

        return (new HomeController)->show($accueil);
    }

    /**
     * Récupère le chemin du controller à partir du nom du modèle
     */
    private function getControllerNameFromModel(?string $modelName): ?string
    {

        if (! $modelName) {
            return null;
        }

        $modelNameParts = explode('\\', $modelName);
        $modelName = end($modelNameParts);
        $controllerName = $modelName . 'Controller';
        $controllerNamespace = $this->controllersBaseNamespace . $controllerName;

        if (class_exists($controllerNamespace)) {
            return $controllerNamespace;
        }

        return null;
    }
}
