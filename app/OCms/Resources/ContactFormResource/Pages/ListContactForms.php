<?php

namespace App\OCms\Resources\ContactFormResource\Pages;

use App\OCms\Resources\ContactFormResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContactForms extends ListRecords
{
    protected static string $resource = ContactFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
