<?php

namespace App\OCms\Blocks;

use App\OCms\Schemas\ComplexButtonSchema;
use Filament\Forms\Components\Builder\Block;

class ButtonBlock
{
    public static function make(): Block
    {
        return Block::make('ocms-blocks::button')
            ->label('Bouton')
            ->icon('heroicon-o-link')
            ->schema(ComplexButtonSchema::get());
    }
}
