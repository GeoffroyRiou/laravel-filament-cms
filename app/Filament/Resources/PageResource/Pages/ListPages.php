<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use App\Filament\Resources\PostResource\Pages\PostListPage;

class ListPages extends PostListPage
{
    protected static string $resource = PageResource::class;
}
