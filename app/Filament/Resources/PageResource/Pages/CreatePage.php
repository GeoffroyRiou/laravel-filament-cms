<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use App\Filament\Resources\PostResource\Pages\PostCreatePage;

class CreatePage extends PostCreatePage
{
    protected static string $resource = PageResource::class;
}
