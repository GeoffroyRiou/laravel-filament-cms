<?php

declare(strict_types=1);

namespace App\Filament\Blocks\CMSSchemas;

use App\Filament\Blocks\CMSSelects\IconSelect;
use App\Filament\Blocks\CMSSelects\PostSelect;
use App\Models\Page;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
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
                    'file' => 'Fichier public',
                    'filePrivate' => 'Fichier privé',
                ])
                ->required()
                ->inline()
                ->live(),
            PostSelect::make($prefix . 'post')
                ->label('Page')
                ->generateOptions(Page::class)
                ->visible(fn(Get $get): bool => $get('type') == 'page'),
            TextInput::make('link')
                ->label('Lien')
                ->url()
                ->required()
                ->visible(fn(Get $get): bool => $get('type') == 'customLink'),
            FileUpload::make('file')
                ->label('Fichier public')
                ->maxSize(1024 * 5)
                ->visible(fn(Get $get): bool => $get('type') == 'file'),
            FileUpload::make('filePrivate')
                ->label('Fichier privé')
                ->maxSize(1024 * 5)
                ->disk('private')
                ->visible(fn(Get $get): bool => $get('type') == 'filePrivate'),
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
