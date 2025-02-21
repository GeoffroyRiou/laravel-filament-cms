<?php

namespace App\Filament\Resources\MediaLibraryFileResource\Pages;

use App\Filament\Resources\MediaLibraryFileResource;
use Filament\Resources\Pages\Page;

class MediaLibraryPage extends Page
{
    protected static string $resource = MediaLibraryFileResource::class;
    protected static ?string $title = 'Bibliothèque de Médias';

    protected static string $view = 'filament.resources.media-library-file-resource.pages.media-library-page';
}
