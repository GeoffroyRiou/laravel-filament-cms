<?php

namespace App\OCms\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;

class TimelineBlock
{
    public static function make(): Block
    {
        return Block::make('ocms::timeline')
            ->label('Frise chronologique')
            ->icon('heroicon-o-clock')
            ->schema([
                Repeater::make('items')
                    ->label('')
                    ->itemLabel(fn(array $state): ?string => $state['title'] ?? 'Date')
                    ->schema([
                        DatePicker::make('date')->label('Date')->required(),
                        TextInput::make('title')->label('Titre')->required(),
                        Textarea::make('text')->label('Texte')->required(),
                    ])
                    ->cloneable()
                    ->collapsed()
                    ->collapsible()
                    ->addActionLabel('Ajouter une date')
            ]);
    }
}
