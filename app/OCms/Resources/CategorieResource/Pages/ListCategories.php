<?php

namespace App\OCms\Resources\CategorieResource\Pages;

use App\OCms\Resources\CategorieResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategories extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = CategorieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
