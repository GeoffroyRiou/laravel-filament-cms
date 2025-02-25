<?php

namespace App\OCms\Blocks;

use App\OCms\Fields\FormSelect;
use Filament\Forms\Components\Builder\Block;

class ContactFormBlock
{
    public static function make(): Block
    {
        return Block::make('ocms::contact-form')
            ->label('Formulaire de contact')
            ->icon('heroicon-o-envelope')
            ->schema([
                FormSelect::make('contenu')
                    ->label('')
                    ->required(),
            ]);
    }
}
