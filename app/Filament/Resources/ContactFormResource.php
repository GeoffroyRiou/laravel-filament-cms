<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactFormResource\Pages;
use App\Models\ContactForm;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactFormResource extends Resource
{
    use Translatable;

    protected static ?string $model = ContactForm::class;

    protected static ?string $modelLabel = 'Formulaire';

    protected static ?string $navigationLabel = 'Formulaires';

    protected static ?string $navigationGroup = 'Formulaires';

    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nom')
                    ->label('Nom du formulaire')
                    ->required(),
                TextInput::make('sujet')
                    ->label('Sujet')
                    ->required(),
                TextInput::make('destinataires')
                    ->label('Destinataires')
                    ->helperText('Emails séparés par des virgules')
                    ->required(),
                Builder::make('champs')
                    ->label('Champs du formulaire')
                    ->addActionLabel('Ajouter un nouveau champ')
                    ->blocks([
                        Builder\Block::make('texte')
                            ->schema([
                                TextInput::make('label')
                                    ->label('Label')
                                    ->required(),
                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required(),
                                Select::make('type')->options(['ligne' => 'Ligne', 'email' => 'Email'])->required(),
                                TextInput::make('mask')
                                    ->label('Masque')
                                    ->helperText('Si besoin, renseigner le format à vérifier lors de la validation du champ'),
                                Checkbox::make('requis')->label('Champ requis'),
                                Toggle::make('large')->label('Pleine largeur')->default(false),
                            ]),
                        Builder\Block::make('bloc_texte')
                            ->label('Bloc de texte')
                            ->schema([
                                TextInput::make('label')
                                    ->label('Label')
                                    ->required(),
                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required(),
                                Checkbox::make('requis')->label('Champ requis'),
                                Toggle::make('large')->label('Pleine largeur')->default(false),
                            ]),
                        Builder\Block::make('choix')
                            ->label('Choix multiples')
                            ->schema([
                                TextInput::make('label')
                                    ->label('Label')
                                    ->required(),
                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required(),
                                KeyValue::make('valeurs')->label('Valeurs possibles')->required(),
                                Select::make('type')->options(['checkbox' => 'Cases à cocher', 'radio' => 'Boutons radio', 'select' => 'Liste de sélection'])->required(),
                                Checkbox::make('requis')->label('Champ requis'),
                                Toggle::make('large')->label('Pleine largeur')->default(false),
                            ]),
                        Builder\Block::make('fichier')
                            ->schema([
                                TextInput::make('label')
                                    ->label('Label')
                                    ->required(),
                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required(),
                                TextInput::make('format')
                                    ->label('Formats autorisés')
                                    ->helperText('Séparer par des virgules. ex: jpg,png'),
                                Checkbox::make('requis')->label('Champ requis'),
                                Toggle::make('large')->label('Pleine largeur')->default(false),
                            ]),
                        Builder\Block::make('optin')
                            ->schema([
                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required(),
                                RichEditor::make('texte')
                                    ->label('Texte'),
                                Checkbox::make('requis')->label('Champ requis'),
                                Toggle::make('large')->label('Pleine largeur')->default(false),
                            ]),

                    ])->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nom'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactForms::route('/'),
            'create' => Pages\CreateContactForm::route('/create'),
            'edit' => Pages\EditContactForm::route('/{record}/edit'),
        ];
    }
}
