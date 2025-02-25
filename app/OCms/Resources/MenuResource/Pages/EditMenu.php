<?php

namespace App\OCms\Resources\MenuResource\Pages;

use App\OCms\Resources\MenuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMenu extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = MenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
