<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Menu extends Model
{
    use HasTranslations;

    protected $fillable = [
        'nom',
        'liens',
    ];

    public $translatable = [
        'nom',
        'liens',
    ];

    protected function casts(): array
    {
        return [
            'liens' => 'array',
        ];
    }
}
