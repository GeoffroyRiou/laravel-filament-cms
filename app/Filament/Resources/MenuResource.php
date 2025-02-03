<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Models\Categorie;
use App\Models\Menu;
use App\Models\Post;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MenuResource extends Resource
{
    use Translatable;

    protected static ?string $navigationGroup = 'Configuration';

    protected static ?string $model = Menu::class;

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Titre + slug
                Section::make([
                    TextInput::make('nom')
                        ->required()
                        ->columnSpan(2),
                ]),
                // Liens
                Section::make([
                    Builder::make('liens')
                        ->label('')
                        ->addActionLabel('Ajouter un lien')
                        ->reorderableWithButtons()
                        ->collapsible()
                        ->cloneable()
                        ->blocks([
                            Builder\Block::make('lien')
                                ->label('Lien personnalisé')
                                ->schema([
                                    TextInput::make('texte')
                                        ->label('Texte du lien')
                                        ->required(),
                                    TextInput::make('lien')
                                        ->required(),
                                    Checkbox::make('blank')
                                        ->label('Ouvrir dans un nouvel onglet'),
                                    Select::make('niveau')->options([
                                        '1' => 'Niveau 1',
                                        '2' => 'Niveau 2',
                                    ])->required()
                                ]),
                            Builder\Block::make('page')
                                ->label('Page du site')
                                ->schema(
                                    [
                                        Select::make('page')
                                            ->label('')
                                            ->options(Post::withoutGlobalScopes()->get()->pluck('titre', 'id'))
                                            ->searchable()
                                            ->required(),
                                        Select::make('niveau')->options([
                                            '1' => 'Niveau 1',
                                            '2' => 'Niveau 2',
                                        ])->required(),
                                    ]
                                ),
                            Builder\Block::make('categorie')
                                ->label('Catégorie du site')
                                ->schema(
                                    [
                                        Select::make('categorie')
                                            ->label('')
                                            ->options(Categorie::withoutGlobalScopes()->get()->pluck('nom', 'id'))
                                            ->searchable()
                                            ->required(),
                                        Select::make('niveau')->options([
                                            '1' => 'Niveau 1',
                                            '2' => 'Niveau 2',
                                        ])->required(),
                                    ]
                                ),
                        ])->columnSpan(2),
                ]),
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
