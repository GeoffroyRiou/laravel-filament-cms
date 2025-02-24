<?php

namespace App\Filament\CMSSchemas;

use App\Filament\CMSFields\MediaLibraryFileField;

class ImageSchema
{
    public static function get(
        string $prefix = '',
        string $label = 'Image',
    ): array {
        return [
            MediaLibraryFileField::make($prefix . 'image')
                ->imagesOnly(true)
                ->label($label)
                ->live(),
        ];
    }
}
