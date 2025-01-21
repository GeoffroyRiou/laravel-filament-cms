<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RubriqueResource\Pages;
use App\Filament\Resources\RubriqueResource\RelationManagers;
use App\Models\Rubrique;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RubriqueResource extends CategorieResource
{
    use Translatable;
    protected static ?string $model = Rubrique::class;

    protected static ?string $modelLabel = 'Rubriques';

    protected static ?string $navigationGroup = 'Pages';

    protected static ?int $navigationSort = 4;


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRubriques::route('/'),
            'create' => Pages\CreateRubrique::route('/create'),
            'edit' => Pages\EditRubrique::route('/{record}/edit'),
        ];
    }
}
