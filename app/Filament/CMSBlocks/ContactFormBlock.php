<?php

namespace App\Filament\CMSBlocks;

use App\Filament\CMSFields\FormSelect;
use Filament\Forms\Components\Builder\Block;

class ContactFormBlock
{
    public static function make(): Block
    {
        return Block::make('cms-blocks.contact-form')
            ->label('Formulaire de contact')
            ->icon('heroicon-o-envelope')
            ->schema([
                FormSelect::make('contenu')
                    ->label('')
                    ->required(),
            ]);
    }
}
