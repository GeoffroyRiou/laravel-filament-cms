<?php

namespace App\Models;

use App\Enums\PostsStatus;
use App\Models\Scopes\PostScope;
use App\Traits\HasCMSFields;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Spatie\Translatable\HasTranslations;

#[ScopedBy([new PostScope()])]
class Post extends Model
{
    use HasSEO;
    use HasTranslations;
    use HasCMSFields;

    public $table = 'posts';

    protected $categorieModel = Categorie::class;
    public static string $routeSlug = 'article';

    protected $fillable = [
        'titre',
        'slug',
        'model',
        'statut',
        'excerpt',
        'contenu',
        'custom',
        'media_library_file_id',
        'order',
        'private',
    ];

    public $translatable = [
        'titre',
        'slug',
        'excerpt',
        'contenu',
        'custom',
    ];

    protected $attributes = [
        'contenu' => '',
    ];

    // Transformation du contenu json en tableau
    protected function casts(): array
    {
        return [
            'contenu' => 'array',
            'custom' => 'array',
        ];
    }

    /**
     * Actions à effectuer à la création et à la mise à jour d'un post
     */
    protected static function booted(): void
    {
        static::creating(fn(self $post) => self::updateMandatoryDataBeforeSave($post));
        static::updating(fn(self $post) => self::updateMandatoryDataBeforeSave($post));
    }

    /**
     * Renseigne le modèle correspondant au type de post
     */
    private static function updateMandatoryDataBeforeSave(self $post): void
    {
        $post->model = get_class($post);
    }

    /**
     * Scope pour ne récupérer que les posts publiés
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('statut', PostsStatus::Published->value);
    }

    /**
     * Gère la relation avec les catégories
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany($this->categorieModel, 'post_categorie', 'post_id', 'categorie_id');
    }

    /**
     * Gère la relation avec les tags
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id');
    }

    /**
     * Retourne l'url du post en utilisation le modèle du post pour générer le nom de la route
     */
    public function getUrl(bool $addLocaleToUrl = false): string
    {

        // Prise en compte de la locale admin ou front
        $locale = $this->translationLocale ?? app()->getLocale();

        $params = [
            'slug' => $this->slug,
        ];
        $routeStr = static::$routeSlug . '.single';
        $categories =  $this->categories;

        if (count($categories)) {

            $currentCategorie = $categories->first();
            $categoriesPath = '';

            while ($currentCategorie) {
                $categoriesPath = "{$currentCategorie->getTranslation('slug',$locale)}/" . $categoriesPath;
                $currentCategorie = $currentCategorie->parent;
            }

            $params['parents'] = trim($categoriesPath, '/');
            $routeStr .= '.hierarchical';
        }

        return route($routeStr, $params) . ($addLocaleToUrl ? '?language=' . $this->translationLocale : '');
    }

    /**
     * Génère les données du fil d'ariane du post
     *
     * @return array<int,array<string,string>>
     */
    public function getBreadcrumb(): array
    {

        $links = [
            [
                'lien' => $this->getUrl(),
                'texte' => $this->titre,
            ],
        ];

        if (! count($this->categories)) {
            return $links;
        }

        $currentCategorie = $this->categories[0];

        while ($currentCategorie) {
            array_unshift($links, [
                'lien' => $currentCategorie->getUrl(),
                'texte' => $currentCategorie->nom,
            ]);
            $currentCategorie = $currentCategorie->parent;
        }

        return $links;
    }
}
