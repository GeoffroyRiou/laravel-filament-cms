<?php

namespace App\OCms\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    public $table = 'settings';

    protected $fillable = [
        'facebook',
        'linkedin',
        'x',
        'instagram',
        'telephone',
        'adresse',
        'email',
        'gtag',
        'matomo',
    ];
}
