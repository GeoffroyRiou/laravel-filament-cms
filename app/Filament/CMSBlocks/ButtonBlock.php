<?php

namespace App\Filament\CMSBlocks;

use App\Filament\CMSSchemas\ComplexButtonSchema;
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
