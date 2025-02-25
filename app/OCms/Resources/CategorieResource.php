<?php

namespace App\OCms\Resources;

use App\OCms\Resources\CategorieResource\Pages;
use App\OCms\Models\Categorie;
use CodeWithDennis\FilamentSelectTree\SelectTree;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CategorieResource extends Resource
{
    use Translatable;

    protected static ?string $model = Categorie::class;

    protected static ?string $modelLabel = 'Catégorie';

    protected static ?string $navigationGroup = 'Articles';

    protected static ?int $navigationSort = 2;

    protected static function getCmsFormSchema(
        array $customFields = [],
    ): array {
        return [
            TextInput::make('nom')->required(),
            TextInput::make('slug')
                ->helperText('Texte apparaissant dans l\'url. Généré automatiquement si laissé vide.'),
            SelectTree::make('parent_id')
                ->label('Catégorie parente')
                ->placeholder(__('Choisir une categorie'))
                ->emptyLabel(__('Aucun résultat'))
                ->defaultOpenLevel(2)
                ->enableBranchNode()
                ->relationship(relationship: 'parent', titleAttribute: 'nom', parentAttribute: 'parent_id', modifyChildQueryUsing: function ($query, $record) {
                    if ($record) {
                        $query->where('id', '!=', $record->id);
                    }

                    return $query;
                }),
            (
                ! empty($customFields) ?
                Section::make('Contenu')
                ->schema([
                    Repeater::make('custom') // Utilisation d'un repeater pour stocker la totalité des données dans une seule colonne de base
                        ->label('')
                        ->schema($customFields)
                        ->defaultItems(1)
                        ->deletable(false)
                        ->reorderable(false)
                        ->addable(false)
                        ->columnSpan(2),
                ])
                : Hidden::make('ignoredField') // Hack car il faut absolument un champ retourné. Ne sera pas pris en compte à l'enregistrement car pas fillable
            ),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::getCmsFormSchema());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nom')->label('Catégorie'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('voir')
                    ->icon('heroicon-o-eye')
                    ->url(fn(Categorie $record) => $record->getUrl(true)),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                Action::make('arbo')
                    ->label("Voir l'arborescence")
                    ->icon('heroicon-o-bars-arrow-down')
                    ->modalHeading('Arborescence')
                    ->modalContent(view('filament.modals.categories', [
                        'categories' => static::$model::whereNull('parent_id')->get(),
                    ]))
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false)
                    ->button(),
            ])
            ->reorderable('order');
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CategorieCreate::route('/create'),
            'edit' => Pages\CategorieEdit::route('/{record}/edit'),
        ];
    }
}
