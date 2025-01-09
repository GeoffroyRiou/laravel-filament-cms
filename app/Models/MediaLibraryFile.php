<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaLibraryFile extends Model implements HasMedia
{
    use InteractsWithMedia;

    public $table = 'media_library_files';

    protected $fillable = [
        'nom',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {

        $this->addMediaConversion('thumbnail')
            ->fit(Fit::Crop, 300, 300)
            ->format('avif')
            ->nonQueued();
    }

    public function isImage(): bool
    {

        if (! $this->hasMedia('*')) {
            return false;
        }

        $media = $this->getFirstMedia('*');

        return strpos($media->mime_type, 'image') !== false;
    }
}
