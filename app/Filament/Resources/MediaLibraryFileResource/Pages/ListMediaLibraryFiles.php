<?php

namespace App\Filament\Resources\MediaLibraryFileResource\Pages;

use App\Filament\Resources\MediaLibraryFileResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMediaLibraryFiles extends ListRecords
{
    protected static string $resource = MediaLibraryFileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
