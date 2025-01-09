<?php

namespace App\Filament\Resources\MediaLibraryFileResource\Pages;

use App\Filament\Resources\MediaLibraryFileResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMediaLibraryFile extends EditRecord
{
    protected static string $resource = MediaLibraryFileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
