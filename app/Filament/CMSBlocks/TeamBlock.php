<?php

namespace App\Filament\CMSBlocks;

use App\Filament\CMSSchemas\ImageSchema;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;

class TeamBlock
{
    public static function make(): Block
    {
        return Block::make('cms.team')
            ->label('Equipe')
            ->icon('heroicon-o-user-group')
            ->schema([
                ToggleButtons::make('bgColor')->label('Couleur de fond')->options([
                    'main-l' => 'Vert clair',
                    'second-l' => 'Bleu/vert',
                ])->required()->inline(),
                Repeater::make('members')
                    ->label('')
                    ->itemLabel(fn(array $state): ?string => $state['firstname'] ?? 'Membre')
                    ->schema([
                        Section::make('')->schema(ImageSchema::get()),
                        TextInput::make('firstname')->label('Prénom')->required(),
                        TextInput::make('job')->label('Métier')->required(),
                        TextInput::make('role')->label('Rôle'),
                        RichEditor::make('text')->label('Présentation')->required(),
                        TextInput::make('duration')->label('Ancienneté')->required()->prefix('Avec nous depuis : '),
                    ])
                    ->cloneable()
                    ->collapsed()
                    ->collapsible()
                    ->addActionLabel('Ajouter un.e membre')
            ]);
    }
}
