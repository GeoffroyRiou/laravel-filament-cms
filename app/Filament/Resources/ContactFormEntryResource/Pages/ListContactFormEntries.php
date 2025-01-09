<?php

namespace App\Filament\Resources\ContactFormEntryResource\Pages;

use App\Filament\Resources\ContactFormEntryResource;
use Filament\Resources\Pages\ListRecords;

class ListContactFormEntries extends ListRecords
{
    protected static string $resource = ContactFormEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
