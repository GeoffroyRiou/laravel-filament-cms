<?php

namespace App\Filament\Blocks\CMSSchemas;

use App\Forms\Components\MediaFileField;

class ImageSchema
{
    public static function get(
        string $prefix = '',
        string $label = 'Image',
    ): array {
        return [
            MediaFileField::make($prefix . 'image')
                ->imagesOnly(true)
                ->label($label),
        ];
    }
}
