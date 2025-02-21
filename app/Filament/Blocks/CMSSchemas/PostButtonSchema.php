<?php

namespace App\Filament\Blocks\CMSSchemas;

use App\Enums\ButtonStyles;
use App\Filament\Blocks\CMSSelects\PostSelect;
use App\Models\Page;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class PostButtonSchema
{
    public static function get(
        string $prefix = '',
        bool $hasStyle = true,
        string $postModel = Page::class,
    ): array
    {
        return [
            PostSelect::make($prefix . 'post')->label('Page')->generateOptions($postModel),
            Select::make($prefix . 'style')
                ->label('Style visuel')
                ->options(
                    getAllEnumValues(ButtonStyles::cases())
                )
                ->visible($hasStyle),
            TextInput::make($prefix . 'text')->label('Texte'),
        ];
    }
}
