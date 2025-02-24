<?php

namespace App\Filament\CMSBlocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class SliderLogosBlock
{
    public static function make(): Block
    {
        return Block::make('cms.slider-logos')
            ->label('Carousel de logos')
            ->icon('heroicon-o-rectangle-stack')
            ->schema([
                TextInput::make('title')->label('Titre'),
                Repeater::make('logos')
                    ->label('')
                    ->itemLabel(fn(array $state): ?string => 'Logo ' . ($state['label'] ?? ''))
                    ->schema([
                        FileUpload::make('logo')
                            ->acceptedFileTypes(['image/svg+xml'])
                            ->maxSize(1024),
                        TextInput::make('label')->label('Légende'),
                        TextInput::make('link')->label('Lien')->url()->required(),
                    ])
                    ->cloneable()
                    ->collapsed()
                    ->collapsible()
                    ->addActionLabel('Ajouter un autre logo')
            ]);
    }
}
