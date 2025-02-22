<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MediaLibraryFile extends Model
{

    public $table = 'media_library_files';

    protected $fillable = [
        'name',
        'path',
    ];

    // TODO : Améliorer
    public function isImage(): bool
    {
        $filePath = Storage::disk('public')->path($this->path);
        return in_array(mime_content_type($filePath), ['image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/svg+xml']);
    }

    public function getUrl(): string
    {
        return imageUrl($this->path);
    }
}
