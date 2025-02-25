<?php

namespace App\OCms\Blocks;

use App\OCms\Schemas\ComplexButtonSchema;
use App\OCms\Schemas\ImageSchema;
use App\OCms\Schemas\PostButtonSchema;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;

class TextImageBlock
{
    public static function make(): Block
    {
        return Block::make('ocms::text-image')
            ->label('Texte avec image d\'illustration')
            ->icon('heroicon-o-rectangle-group')
            ->schema([
                Section::make('')->schema(ImageSchema::get()),
                Toggle::make('image_right')->label('Image à droite')->default(false),
                Toggle::make('image_full')->label('Image couvrante')->default(false),
                TextInput::make('title')->label('Titre'),
                Select::make('bgTextColor')->label('Couleur de fond du texte')->options(config('ocms::cssBackgrounds'))->required(),
                RichEditor::make('text')->label('Texte')->required(),
                Toggle::make('add_button')->label('Activer le bouton')->default(true)->live(),
                Section::make('')
                    ->label('Bouton')
                    ->schema(ComplexButtonSchema::get())
                    ->visible(fn(Get $get): bool => $get('add_button')),
            ]);
    }
}
