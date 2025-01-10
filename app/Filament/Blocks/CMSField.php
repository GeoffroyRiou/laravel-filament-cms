<?php

namespace App\Filament\Blocks;

use App\Forms\Components\MediaFileField;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class CMSField extends Builder
{
    /**
     * Configure le schéma du formulaire pour le CMSField.
     *
     * Cette méthode initialise le schéma du formulaire en ajoutant divers composants
     * tels que des champs de texte, des champs de sélection, un éditeur enrichi, des
     * interrupteurs de basculement et des répétiteurs. Le schéma est défini en utilisant
     * la classe Builder\Block et ses composants de schéma correspondants.
     *
     * @return void
     */
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
                            ->required()
                            ->toolbarButtons([
                                'blockquote',
                                'bold',
                                'bulletList',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'strike',
                                'underline',
                            ]),
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
            ]);
    }
}
