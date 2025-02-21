<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaLibraryFile extends Model
{

    public $table = 'media_library_files';

    protected $fillable = [
        'name',
        'path',
    ];
}
