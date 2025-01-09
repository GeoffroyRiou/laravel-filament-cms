<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ContactForm extends Model
{
    use HasTranslations;

    protected $fillable = [
        'nom',
        'champs',
        'sujet',
        'destinataires',
    ];

    public $translatable = [
        'champs',
    ];

    // Transformation du contenu json en tableau
    protected function casts(): array
    {
        return [
            'champs' => 'array',
        ];
    }

    /**
     * Retourne les données d'un champs du formulaire
     */
    public function getFieldInformations(string $key): ?array
    {

        foreach ($this->champs as $champ) {
            if ($champ['data']['slug'] === $key) {
                return $champ;
            }
        }

        return null;
    }
}
