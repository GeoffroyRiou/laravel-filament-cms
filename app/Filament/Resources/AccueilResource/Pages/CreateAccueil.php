<?php

namespace App\Filament\Resources\AccueilResource\Pages;

use App\Filament\Resources\AccueilResource;
use App\Filament\Resources\PostResource\Pages\PostCreatePage;

class CreateAccueil extends PostCreatePage
{
    protected static string $resource = AccueilResource::class;
}
