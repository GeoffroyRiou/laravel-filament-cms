<?php

namespace App\Filament\Blocks\CMSSchemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;

class ImageSchema
{
    public static function get(
        string $prefix = '',
        string $label = 'Image',
    ): array {
        return [
            FileUpload::make($prefix.'image')
                ->label($label)
                ->image()
                ->maxSize(5120),
            TextInput::make('alt')->label('Texte alternatif')->required()
        ];
    }
}
