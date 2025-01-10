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
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('home_visuel-1')
            ->fit(Fit::Crop, 510, 430)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('home_visuel-2')
            ->fit(Fit::Crop, 240, 430)
            ->format('webp')
            ->nonQueued();


        $this->addMediaConversion('reference-large')
            ->fit(Fit::Crop, 1085, 490)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('reference-big')
            ->fit(Fit::Crop, 625, 585)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('reference-small')
            ->fit(Fit::Crop, 510, 480)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('reference-mobile')
            ->fit(Fit::Crop, 310, 400)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('logo')
            ->fit(Fit::Fill, 150, 150)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('team')
            ->fit(Fit::Crop, 249, 372)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('colored-block-small')
            ->fit(Fit::Crop, 420, 380)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('colored-block')
            ->fit(Fit::Crop, 760, 760)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('page-header-desktop')
            ->fit(Fit::Crop, 1920, 460)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('page-header-mobile')
            ->fit(Fit::Crop, 760, 280)
            ->format('webp')
            ->nonQueued();
    }

    public function isImage(): bool
    {

        if (!$this->hasMedia('*')) {
            return false;
        }

        $media = $this->getFirstMedia('*');

        return strpos($media->mime_type, 'image') !== false;
    }
}
