<?php

namespace App\Filament\CMSBlocks;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Builder\Block;

class RichContentBlock
{
    public static function make(): Block
    {
        return Block::make('cms-blocks.rich-content')
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
