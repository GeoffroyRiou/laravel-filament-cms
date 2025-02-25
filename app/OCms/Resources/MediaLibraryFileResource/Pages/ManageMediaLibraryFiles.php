<?php

namespace App\OCms\Resources\MediaLibraryFileResource\Pages;

use App\OCms\Resources\MediaLibraryFileResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMediaLibraryFiles extends ManageRecords
{
    protected static string $resource = MediaLibraryFileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
