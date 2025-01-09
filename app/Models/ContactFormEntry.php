<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactFormEntry extends Model
{
    protected $fillable = [
        'formulaire',
        'champs',
        'sujet',
        'destinataires',
    ];

    // Transformation du contenu json en tableau
    protected function casts(): array
    {
        return [
            'champs' => 'array',
        ];
    }
}
