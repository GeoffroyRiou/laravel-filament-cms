<?php

namespace App\Filament\Blocks;

use App\Forms\Components\MediaFileField;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class CMSField extends Builder
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label('')
            ->addActionLabel('Ajouter un bloc')
            ->schema([
                Builder\Block::make('titre')->schema([
                    TextInput::make('texte')
                        ->label('Texte du titre')
                        ->required(),
                    Select::make('niveau')
                        ->options([
                            'h2' => 'Titre 2',
                            'h3' => 'Titre 3',
                            'h4' => 'Titre 4',
                        ])
                        ->required(),
                ]),
                Builder\Block::make('rich_paragraphe')
                    ->label('Paragraphe HTML')
                    ->schema([
                        RichEditor::make('contenu')
                            ->label('Contenu')
                            ->required(),
                    ]),
                Builder\Block::make('paragraphe')
                    ->label('Paragraphe')
                    ->schema([
                        Textarea::make('contenu')
                            ->label('Contenu')
                            ->required(),
                    ]),
                Builder\Block::make('formulaire')
                    ->label('Formulaire de contact')
                    ->schema([
                        ContactFormSelect::make('contenu')
                            ->label('')
                            ->required(),
                    ]),
                Builder\Block::make('image')
                    ->schema([
                        MediaFileField::make('file')
                            ->label('Image')
                            ->imagesOnly(true)
                            ->required(),
                    ]),
                Builder\Block::make('fichier')
                    ->schema([
                        MediaFileField::make('file')
                            ->label('Fichier')
                            ->filesOnly(true)
                            ->required(),
                    ]),
            ]);
    }
}
