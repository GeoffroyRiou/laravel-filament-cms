<?php

namespace App\Filament\Blocks\CMSBlocks;

use App\Filament\Blocks\CMSSchemas\PostButtonSchema;
use App\Filament\Blocks\CMSSelects\IconSelect;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Get;

class SimpleButtonBlock
{
    public static function make(): Block
    {
        return Block::make('cms.simple-button')
            ->label('Bouton')
            ->icon('heroicon-o-link')
            ->schema([
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
                Section::make('Page')
                    ->schema(PostButtonSchema::get())
                    ->visible(fn(Get $get): bool => $get('type') == 'page'),
                Section::make('Lien')
                    ->schema([
                        TextInput::make('link')->label('Lien')->url()->required(),
                        TextInput::make('label')->label('Intitulé du bouton')->required(),
                    ])
                    ->visible(fn(Get $get): bool => $get('type') == 'customLink'),
                Section::make('Fichier public')
                    ->schema([
                        FileUpload::make('file')
                            ->maxSize(1024 * 5),
                        TextInput::make('label')->label('Intitulé du bouton')->required(),
                    ])
                    ->visible(fn(Get $get): bool => $get('type') == 'file'),
                Section::make('Fichier privé')
                    ->schema([
                        FileUpload::make('filePrivate')
                            ->maxSize(1024 * 5)
                            ->disk('private'),
                        TextInput::make('label')->label('Intitulé du bouton')->required(),
                    ])
                    ->visible(fn(Get $get): bool => $get('type') == 'filePrivate'),
                TextInput::make('subtitle')->label('Soustitre'),
                ToggleButtons::make('style')
                    ->label('Style visuel')
                    ->options([
                        '-white' => 'Blanc',
                        '-main-m' => 'Vert foncé',
                    ])->inline(),
            ]);
    }
}
