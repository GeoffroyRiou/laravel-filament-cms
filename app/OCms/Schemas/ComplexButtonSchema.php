<?php

declare(strict_types=1);

namespace App\OCms\Schemas;

use App\OCms\Fields\IconSelect;
use App\OCms\Fields\PostSelect;
use App\OCms\Fields\MediaLibraryFileField;
use App\OCms\Models\Page;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Get;

class ComplexButtonSchema
{

    public static function get(
        string $prefix = '',
        bool $hasStyle = true,
        string $postModel = Page::class,
    ): array {
        return [
            IconSelect::make('icon')
                ->label('Icône')
                ->generateOptions(),
            ToggleButtons::make('type')
                ->label('Type de lien')
                ->options([
                    'page' => 'Page du site',
                    'customLink' => 'Lien personnalisé',
                    'file' => 'Fichier',
                ])
                ->required()
                ->inline()
                ->live(),
            PostSelect::make($prefix . 'post')
                ->label('Page')
                ->generateOptions($postModel)
                ->visible(fn(Get $get): bool => $get('type') == 'page'),
            TextInput::make('link')
                ->label('Lien')
                ->url()
                ->required()
                ->visible(fn(Get $get): bool => $get('type') == 'customLink'),
            MediaLibraryFileField::make('file')
                ->label('Fichier public')
                ->maxSize(1024 * 5)
                ->visible(fn(Get $get): bool => $get('type') == 'file'),
            TextInput::make('label')
                ->label('Intitulé du bouton')
                ->required(),
            Select::make($prefix . 'style')
                ->label('Style visuel')
                ->options(config('cms.cssButtons'))
                ->visible($hasStyle),
        ];
    }
}
