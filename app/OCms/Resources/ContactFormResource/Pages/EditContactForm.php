<?php

namespace App\OCms\Resources\ContactFormResource\Pages;

use App\OCms\Resources\ContactFormResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContactForm extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = ContactFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
