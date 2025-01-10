<?php

namespace App\Filament\Resources;

use App\Filament\Blocks\CMSPageFormSelect;
use App\Filament\Resources\AccueilResource\Pages;
use App\Forms\Components\MediaFileField;
use App\Models\Accueil;
use App\Models\Expertise;
use App\Models\Page;
use App\Models\Post;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use RalphJSmit\Filament\SEO\SEO;

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
