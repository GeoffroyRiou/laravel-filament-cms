<?php

namespace App\Filament\Blocks\CMSBlocks;

use App\Filament\Blocks\CMSSelects\FormSelect;
use Filament\Forms\Components\Builder\Block;

class ContactFormBlock
{
    public static function make(): Block
    {
        return Block::make('formulaire')
            ->label('Formulaire de contact')
            ->icon('heroicon-o-envelope')
            ->schema([
                FormSelect::make('contenu')
                    ->label('')
                    ->required(),
            ]);
    }
}