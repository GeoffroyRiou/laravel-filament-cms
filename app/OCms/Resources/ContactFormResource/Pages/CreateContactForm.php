<?php

namespace App\OCms\Resources\ContactFormResource\Pages;

use App\OCms\Resources\ContactFormResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateContactForm extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = ContactFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
