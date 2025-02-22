<?php

namespace App\Filament\Blocks\CMSBlocks;

use App\Filament\Blocks\CMSSchemas\ComplexButtonSchema;
use Filament\Forms\Components\Builder\Block;

class ButtonBlock
{
    public static function make(): Block
    {
        return Block::make('cms.simple-button')
            ->label('Bouton')
            ->icon('heroicon-o-link')
            ->schema(ComplexButtonSchema::get());
    }
}
