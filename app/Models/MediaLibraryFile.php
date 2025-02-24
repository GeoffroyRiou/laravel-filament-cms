<?php

namespace App\Models;

use App\Services\ImageService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MediaLibraryFile extends Model
{

    public $table = 'media_library_files';

    protected $fillable = [
        'name',
        'path',
        'is_image',
    ];

    protected static function booted()
    {
        static::creating(function ($mediaFile) {
            $mediaFile->is_image = $mediaFile->isImage();
        });

        static::updating(function ($mediaFile) {
            $mediaFile->is_image = $mediaFile->isImage();
        });
    }

    public function isImage(): bool
    {
        $filePath = Storage::disk('public')->path($this->path);
        return in_array(mime_content_type($filePath), config('cms.images.mimeTypes'));
    }

    public function getUrl(int $width = 100, int $height = 100, bool $crop = true): string
    {
        if ($this->is_image) {
            $imageService = app(ImageService::class);
            return Storage::url($imageService->getResizedImage($this->path, $width, $height, $crop));
        }

        return Storage::url($this->path);
    }
}
