<?php

namespace App\Filament\Blocks\CMSBlocks;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Builder\Block;

class GenericContentBlock
{
    public static function make(): Block
    {
        return Block::make('cms.generic-content')
            ->label('Contenu éditorial')
            ->icon('heroicon-o-newspaper')
            ->schema([
                RichEditor::make('content')->label('Contenu')
                    ->required()
                    ->disableToolbarButtons([
                        'attachFiles',
                    ]),
            ]);
    }
}