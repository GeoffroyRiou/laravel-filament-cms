<?php

namespace App\OCms\Schemas;

use App\OCms\Fields\MediaLibraryFileField;

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
