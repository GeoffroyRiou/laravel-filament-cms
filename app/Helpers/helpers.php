<?php

use App\Http\Controllers\CMS\CategorieController;
use App\Http\Controllers\CMS\PostController;
use App\Http\Controllers\Controller;
use App\Models\Accueil;
use App\Models\Categorie;
use App\Models\MediaLibraryFile;
use App\Models\Menu;
use App\Models\Post;
use App\Models\Scopes\CategorieScope;
use App\Models\Scopes\PostScope;
use App\Services\ImageService;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Génère un tableau de noms de classe de controllers 
 * héritant des controller de CMS
 */
function getCmsControllersClasses(): array
{

    $filesystem = new Filesystem();
    $files = $filesystem->files(app_path('Http/Controllers/CMS'));

    $controllers = [];

    foreach ($files as $file) {
        $class = 'App\Http\Controllers\CMS\\' . $filesystem->name($file);
        $reflection = new ReflectionClass($class);

        if ($reflection->isSubclassOf(Controller::class) && (
            $reflection->getName() === PostController::class ||
            $reflection->getName() === CategorieController::class ||
            $reflection->isSubclassOf(PostController::class) ||
            $reflection->isSubclassOf(CategorieController::class)
        )) {
            $controllers[] = $class;
        }
    }

    return $controllers;
}

/**
 * Cherche un fichier de vue en se basant sur un slug
 * Utilisé pour rechercher de manière automatique une vue pour un post
 */
function getViewNameFromSlug(string $search, string $path = null): string | null
{
    $viewsPath = resource_path('views/pages');
    $path = $path ?? $viewsPath;

    $filesystem = new \Illuminate\Filesystem\Filesystem();

    $directories = $filesystem->directories($path);
    $files = $filesystem->files($path);

    foreach ($files as $file) {
        if ($file->getFilename() === $search . '.blade.php') {
            // Extraction du nom de la vue avec sont arbo à partir du dossier views
            return 'pages.' . trim(str_replace([$viewsPath, '.blade.php'], '', $file->getPathname()), '/');
        }
    }

    foreach ($directories as $directory) {
        $result = getViewNameFromSlug($search, $directory);
        if ($result) return $result;
    }

    return null;
}

/**
 * Crée le html nécessaire pour appeler une icône svg disponible dans les assets
 *
 * @param  string  $name  Le nom de l'icône sans l'extension. Par exemple 'question' pour l'icône 'question.svg'
 * @param  string  $cssclass  Classes css à ajouter au tag SVG de l'icône
 */
function svgIcon(string $name, ?string $cssclass = null): ?string
{
    if (!$name) {
        return null;
    }

    $style = $cssclass ?? '';
    $svgStr = "<svg class=\"icon $style\"><use xlink:href=\"#icon-$name\"></use></svg>";

    return $svgStr;
}

/**
 * Retourne le contenu d'un svg sous form de chaine de caractères
 */
function svgContent(string $svgName): string
{
    if (empty($svgName)) {
        return '';
    }

    $svgPath = public_path('images/svgs/' . $svgName . '.svg');

    if (!file_exists($svgPath)) {
        return '';
    }

    return file_get_contents($svgPath);
}

/**
 * Retourne le tableau de liens d'une menu
 * S'il s'agit d'une page, récupère le modèle
 */
function getMenu(int $menuId): array
{
    $menu = Menu::find($menuId);
    $liens = [];
    $currentParent = null;

    if (!empty($menu->liens)) {

        // Récupération des objets posts

        $postsIds = [];
        $categsIds = [];

        foreach ($menu->liens as $lien) {
            if ($lien['type'] === 'page') {
                $postsIds[] = $lien['data']['page'];
            }
            if ($lien['type'] === 'categorie') {
                $categsIds[] = $lien['data']['categorie'];
            }
        }

        $posts = Post::withoutGlobalScope(PostScope::class)->whereIn('id', $postsIds)->get();
        $categs = count($categsIds) ? Categorie::withoutGlobalScope(CategorieScope::class)->whereIn('id', $categsIds)->get() : collect();

        // Constitution des données du menu

        foreach ($menu->liens as $lienMenu) {
            $menuItem = [];

            switch ($lienMenu['type']) {
                case 'page':
                    $post = $posts->where('id', $lienMenu['data']['page'])->first();
                    $menuItem = [
                        'lien' => $post->getUrl(),
                        'texte' => $post->titre,
                    ];
                    break;
                case 'categorie':
                    $categorie = $categs->where('id', $lienMenu['data']['categorie'])->first();
                    $menuItem = [
                        'lien' => $categorie->getUrl(),
                        'texte' => $categorie->nom,
                    ];
                    break;
                default:
                    $menuItem = $lienMenu['data'];
                    break;
            }

            if ($lienMenu['data']['niveau'] == 1) {
                $menuItem['children'] = [];
                $liens[] = $menuItem;
                $currentParent = count($liens) - 1;
            } else {
                $liens[$currentParent]['children'][] = $menuItem;
            }
        }
    }

    return $liens;
}

/**
 * Retourne les valeurs d'un enum d'un tableau
 *
 * @param  array<int,BackedEnum>  $enumValues  Le résultat de la méthode cases() appelée sur un enum
 * @param  bool  $valuesAsKeys  La valeur sera utilisée en tant que clé du tableau plutôt qu'un index
 * @return array<int,string>
 */
function getAllEnumValues(array $enumValues, bool $valuesAsKeys = true): array
{
    $roles = [];

    foreach ($enumValues as $key => $case) {
        $roles[$valuesAsKeys ? $case->value : $key] = __('admin.' . $case->value);
    }

    return $roles;
}

/**
 * Retourne un post en fonction de son id et sans distinction de modèle
 */
function getPost(int $postId): ?Post
{

    // Récupération du post sans distinction de son type
    $post = Post::withoutGlobalScope(PostScope::class)->find($postId);

    if (!$post) {
        return null;
    }

    // Création de l'instance du post en fonction de son modèle
    $model = $post->model::find($postId);

    return $model;
}

/**
 * Retourne un post en fonction de son id et sans distinction de modèle
 */
function getCategorie(int $categId): ?Post
{

    // Récupération du post sans distinction de son type
    $post = Categorie::withoutGlobalScope(PostScope::class)->find($categId);

    if (!$post) {
        return null;
    }

    // Création de l'instance du post en fonction de son modèle
    $model = $post->model::find($categId);

    return $model;
}

/**
 * Retourne l'url d'un post en fonction de son id et sans distinction de modèle
 */
function getPostUrl(int $postId): ?string
{

    $model = getPost($postId);

    if (!$model) {
        return null;
    }

    return $model->getUrl();
}

/**
 * Retourne l'url d'un media. S'il s'agit d'une image, possibilité de définir sa taille
 *
 * @param  int  $mediaId
 */
function getMediaFileUrl(MediaLibraryFile|int $media, string $size = 'thumbnail'): ?string
{

    $media = $media instanceof MediaLibraryFile ? $media : getMediaFile($media);

    if (!$media) {
        return null;
    }
    return $media->getFirstMedia('*')->getUrl($media->isImage() ? $size : null);
}

/**
 * Retourne l'url d'un media. S'il s'agit d'une image, possibilité de définir sa taille
 *
 * @param  int  $mediaId
 */
function getMediaFile(int $mediaId): ?MediaLibraryFile
{
    return  MediaLibraryFile::find($mediaId) ?? null;
}
/**
 * Indique si le post passé en paramètre est de type Accueil
 */
function isFrontPage(Post|Categorie $post = null): bool
{
    return $post ? get_class($post) === Accueil::class : false;
}

function pluralize(string $text, int $count): string
{
    return Str::of($text)->plural($count);
}

/**
 * Retourne un extrait d'un texte
 */
function excerpt(string $text, int $words = 20): string
{
    $textWords = str_word_count(strip_tags($text), 1);
    $truncated = implode(' ', array_slice($textWords, 0, $words));

    return $truncated . (count($textWords) > $words ? '...' : '');
}

/**
 * Convertit une date au format yyyy-mm-dd en format localisé
 */
function formatDateLocalized(string $date, string $format = 'd/m/Y'): string
{
    return Carbon\Carbon::parse($date)->translatedFormat($format);
}

/**
 * Retourne l'url d'une image aux dimensions demandées
 * @param  string  $path  Le chemin de l'image
 * @param  int  $width  La largeur de l'image
 * @param  int  $height  La hauteur de l'image
 * @param  bool  $crop  Indique si l'image doit être recadrée
 * @return string
 **/
function imageUrl(string $path, int $width = 100, int $height = 100, bool $crop = true): string
{
    $imageService = app(ImageService::class);
    return Storage::url($imageService->getResizedImage($path, $width, $height, $crop));
}
