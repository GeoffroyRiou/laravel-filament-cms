<?php

namespace App\OCms\Resources\MenuResource\Pages;

use App\OCms\Resources\MenuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMenus extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = MenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
