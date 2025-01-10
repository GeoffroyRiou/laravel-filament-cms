<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccueilResource\Pages;
use App\Models\Accueil;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

class AccueilResource extends PostResource
{

    protected static ?string $model = Accueil::class;

    protected static ?string $modelLabel = 'Page d\'accueil';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::getCmsFormSchema(hasCategories: false, hasTags: false, hasIllustration: false, hasBuilder: false, customFields: []));
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListAccueils::route('/'),
            'edit' => Pages\EditAccueil::route('/{record}/edit'),
            'create' => Pages\CreateAccueil::route('/create'),
        ];
    }
}
