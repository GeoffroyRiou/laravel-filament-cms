<?php

use App\Models\Categorie;
use App\Models\MediaLibraryFile;
use App\Models\Menu;
use App\Models\Post;
use App\Models\Scopes\PostScope;

/**
 * Crée le html nécessaire pour appeler une icône svg disponible dans les assets
 *
 * @param  string  $name  Le nom de l'icône sans l'extension. Par exemple 'question' pour l'icône 'question.svg'
 * @param  string  $cssclass  Classes css à ajouter au tag SVG de l'icône
 */
function svgIcon(string $name, ?string $cssclass = null): ?string
{
    if (! $name) {
        return null;
    }

    $style = $cssclass ?? 'icon';
    $svgStr = "<svg class=\"$style\"><use xlink:href=\"#icon-$name\"></use></svg>";

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

    $svgPath = public_path('images/svgs/'.$svgName.'.svg');

    if (! file_exists($svgPath)) {
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
    if (! empty($menu->liens)) {
        foreach ($menu->liens as $lienMenu) {
            switch ($lienMenu['type']) {
                case 'page':
                    $post = getPost($lienMenu['data']['page']);

                    $liens[] = [
                        'lien' => $post->getUrl(),
                        'texte' => $post->titre,
                    ];
                    break;
                case 'categorie':
                    $categorie = getCategorie($lienMenu['data']['categorie']);

                    $liens[] = [
                        'lien' => $categorie->getUrl(),
                        'texte' => $categorie->nom,
                    ];
                    break;
                default:
                    $liens[] = $lienMenu['data'];
                    break;
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
        $roles[$valuesAsKeys ? $case->value : $key] = __('admin.'.$case->value);
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

    if (! $post) {
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

    if (! $post) {
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

    if (! $model) {
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

    $media = $media instanceof MediaLibraryFile ? $media : MediaLibraryFile::find($media);

    if (! $media) {
        return null;
    }

    return $media->getFirstMedia('*')->getUrl($media->isImage() ? $size : null);
}

/**
 * Cherche un fichier de vue en se basant sur un slug
 * Utilisé pour rechercher de manière automatique une vue pour un post
 */
function getViewNameFromSlug(string $search, ?string $path = null): ?string
{
    $viewsPath = resource_path('views');
    $path = $path ?? $viewsPath;

    $filesystem = new \Illuminate\Filesystem\Filesystem;

    $directories = $filesystem->directories($path);
    $files = $filesystem->files($path);

    foreach ($files as $file) {
        if (strpos($file->getFilename(), $search) !== false) {
            // Extraction du nom de la vue avec sont arbo à partir du dossier views
            return trim(str_replace([$viewsPath, '.blade.php'], '', $file->getPathname()), '/');
        }
    }

    foreach ($directories as $directory) {
        $result = getViewNameFromSlug($search, $directory);
        if ($result) {
            return $result;
        }
    }

    return null;
}
