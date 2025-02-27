<?php

namespace App\OCms\Resources;

use App\OCms\Resources\PageResource\Pages;
use App\OCms\Models\Page;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class PageResource extends PostResource
{
    protected static ?string $navigationGroup = 'Pages';

    protected static ?string $model = Page::class;

    protected static ?string $navigationLabel = 'Autres pages';

    protected static ?string $modelLabel = 'Page';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::getCmsFormSchema(hasTags: false, hasIllustration: false, hasCategories: false));
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
