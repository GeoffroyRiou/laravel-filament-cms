<?php

namespace App\Filament\Blocks\CMSBlocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;

class FAQBlock
{
    public static function make(): Block
    {
        return Block::make('cms.faq')
            ->label('FAQ')
            ->icon('heroicon-o-question-mark-circle')
            ->schema([
                TextInput::make('title')->label('Titre'),
                RichEditor::make('text')->label('Texte'),
                Repeater::make('questions')
                    ->label('')
                    ->itemLabel(fn(array $state): ?string => $state['title'] ?? 'Question')
                    ->schema([
                        TextInput::make('title')->label('Titre')->required(),
                        RichEditor::make('text')->label('Texte')->required(),
                    ])
                    ->cloneable()
                    ->collapsed()
                    ->collapsible()
                    ->addActionLabel('Ajouter une question')
            ]);
    }
}
