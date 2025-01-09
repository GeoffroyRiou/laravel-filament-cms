<?php

namespace App\Filament\Resources;


use App\Filament\Resources\AccueilResource\Pages;
use App\Models\Accueil;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class AccueilResource extends PostResource
{
    protected static ?string $model = Accueil::class;
    protected static ?string $modelLabel = 'Page d\'accueil';
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::getCmsFormSchema(hasCategories: false, hasTags: false, hasIllustration: false, hasBuilder: false, customFields: [
                TextInput::make('heroTitre')
                    ->label('Titre héro')
                    ->required(),
            ]));
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
