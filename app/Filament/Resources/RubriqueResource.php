<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RubriqueResource\Pages;
use App\Models\Rubrique;
use Filament\Forms\Form;

class RubriqueResource extends CategorieResource
{
    protected static ?string $model = Rubrique::class;

    protected static ?string $modelLabel = 'Rubriques';

    protected static ?string $navigationGroup = 'Pages';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::getCmsFormSchema());
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRubriques::route('/'),
            'create' => Pages\CreateRubrique::route('/create'),
            'edit' => Pages\EditRubrique::route('/{record}/edit'),
        ];
    }
}
