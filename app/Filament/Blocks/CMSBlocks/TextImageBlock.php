<?php

namespace App\Filament\Blocks\CMSBlocks;

use App\Filament\Blocks\CMSSchemas\ImageSchema;
use App\Filament\Blocks\CMSSchemas\PostButtonSchema;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Get;

class TextImageBlock
{
    public static function make(): Block
    {
        return Block::make('cms.text-image')
            ->label('Texte avec image d\'illustration')
            ->icon('heroicon-o-rectangle-group')
            ->schema([
                Section::make('')->schema(ImageSchema::get()),
                Toggle::make('image_right')->label('Image à droite')->default(false),
                Toggle::make('image_full')->label('Image couvrante')->default(false),
                TextInput::make('title_light')->label('Partie du titre claire'),
                TextInput::make('title_dark')->label('Partie du titre foncée'),
                ToggleButtons::make('bgTextColor')->label('Couleur de fond du texte')->options([
                    'white' => 'Blanc (par défaut)',
                    'main-l' => 'Vert clair',
                    'main-m' => 'Vert foncé',
                ])->required()->inline(),
                RichEditor::make('text')->label('Introduction')->required(),
                Toggle::make('add_button')->label('Avec un bouton')->default(true)->live(),
                Section::make('bouton')
                    ->label('Bouton')
                    ->schema(PostButtonSchema::get())
                    ->visible(fn(Get $get): bool => $get('add_button')),
            ]);
    }
}