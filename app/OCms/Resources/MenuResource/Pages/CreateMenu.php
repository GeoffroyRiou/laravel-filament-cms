<?php

namespace App\OCms\Resources\MenuResource\Pages;

use App\OCms\Resources\MenuResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMenu extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = MenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
