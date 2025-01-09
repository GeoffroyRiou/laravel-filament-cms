<?php

namespace App\Filament\Resources\AccueilResource\Pages;

use App\Filament\Resources\AccueilResource;
use App\Filament\Resources\PostResource\Pages\PostListPage;

class ListAccueils extends PostListPage
{
    protected static string $resource = AccueilResource::class;
}
