<?php

namespace App\OCms\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Tag extends Model
{
    use HasTranslations;

    protected $fillable = [
        'nom',
    ];

    public $translatable = [
        'nom',
    ];
}
