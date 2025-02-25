<?php

namespace App\OCms\Controllers;

use App\Http\Controllers\Controller;
use App\OCms\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PostController extends Controller
{
    public static string $model = Post::class;
    protected string $view = 'ocms.pages.page';

    protected ?Post $post = null;

    protected ?string $slug = null;

    public function single(string $slug): View|RedirectResponse
    {
        return $this->getPostPage($slug);
    }

    public function singleHierarchical(string $categories, string $slug): View|RedirectResponse
    {
        return $this->getPostPage($slug);
    }

    /**
     * Récupère le post et retourne sa vue
     */
    private function getPostPage(string $slug): View|RedirectResponse
    {
        $this->slug = $slug;
        $this->post = $post = $this->getPost(static::$model, $slug);

        if ($this->post->private && !Auth::check()) {
            return redirect()->route('login');
        }

        $view = getViewNameFromSlug($post->slug) ?? $this->view;

        return view($view, array_merge(
            compact('post'),
            $this->getOtherViewData()
        ));
    }

    /**
     * Récupère un post à partir de sa classe et de son slug
     * Si pas de contenu pour la langue courante, redirection en home
     */
    protected function getPost(string $classPath, string $slug): Post|RedirectResponse
    {
        $post = $classPath::where('model', $classPath)->where('slug->' . app()->getLocale(), $slug)->firstOrFail();

        // Pas de contenu pour la langue sélectionnée
        if (empty($post->titre) && empty($post->contenu)) {
            return redirect()->route('home');
        }

        return $post;
    }

    /**
     * Permet d'injecter des données supplémentaires à la vue
     */
    protected function getOtherViewData(): array
    {
        return [];
    }
}
