<?php

namespace App\Models;

use App\Models\Scopes\CategorieScope;
use App\Traits\HasCMSFields;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

#[ScopedBy([new CategorieScope()])]
class Categorie extends Model
{
    use HasFactory;
    use HasTranslations;
    use HasCMSFields;

    public $table = 'categories';

    protected $postModel = Post::class;

    protected $fillable = [
        'nom',
        'slug',
        'custom',
        'model',
        'parent_id',
        'order',
    ];

    public $translatable = [
        'nom',
        'slug',
        'custom',
    ];

    // Transformation du contenu json en tableau
    protected function casts(): array
    {
        return [
            'custom' => 'array',
        ];
    }

    /**
     * Actions à effectuer à la création et à la mise à jour d'une categorie
     */
    protected static function booted(): void
    {
        static::creating(fn (self $categorie) => self::updateMandatoryDataBeforeSave($categorie));
        static::updating(fn (self $categorie) => self::updateMandatoryDataBeforeSave($categorie));
    }

    /**
     * Renseigne le modèle correspondant au type de categorie
     */
    private static function updateMandatoryDataBeforeSave(self $categorie): void
    {
        $categorie->model = get_class($categorie);
    }

    public function parent()
    {
        return $this->belongsTo(get_class($this) ?? Categorie::class);
    }

    public function children()
    {
        return $this->hasMany(get_class($this) ?? Categorie::class, 'parent_id');
    }

    public function posts()
    {
        return $this->belongsToMany($this->postModel, 'post_categorie', 'categorie_id', 'post_id');
    }

    public function postsPublished()
    {
        return $this->posts()->published();
    }

    /**
     * Retourne l'url de la catégorie
     */
    public function getUrl(bool $addLocaleToUrl = false): string
    {

        $locale = $this->translationLocale ?? app()->getLocale();

        $path = '';

        if ($this->parent) {

            $currentParent = $this->parent;
            $parentsPath = '';

            while ($currentParent) {
                $parentsPath = "{$currentParent->getTranslation('slug', $locale)}/".$parentsPath;
                $currentParent = $currentParent->parent;
            }
            $path .= trim($parentsPath, '/');
            $params['parents'] = trim($parentsPath, '/');
        }

        return route('cms', [
            'cmsPath' => $path . '/' .$this->slug,
        ]).($addLocaleToUrl ? '?language='.$this->translationLocale : '');
    }

    /**
     * Génère les données du fil d'ariane de la catégorie
     *
     * @return array<int,array<string,string>>
     */
    public function getBreadcrumb(): array
    {

        $links = [
            [
                'lien' => $this->getUrl(),
                'texte' => $this->nom,
            ],
        ];

        if (! $this->parent) {
            return $links;
        }

        $currentParent = $this->parent;

        while ($currentParent) {
            array_unshift($links, [
                'lien' => $currentParent->getUrl(),
                'texte' => $currentParent->nom,
            ]);
            $currentParent = $currentParent->parent;
        }

        return $links;
    }
}
