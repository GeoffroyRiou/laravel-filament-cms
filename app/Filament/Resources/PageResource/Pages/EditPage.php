<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use App\Filament\Resources\PostResource\Pages\PostEditPage;

class EditPage extends PostEditPage
{
    protected static string $resource = PageResource::class;
}
