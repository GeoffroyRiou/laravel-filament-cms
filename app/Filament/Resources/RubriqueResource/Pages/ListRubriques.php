<?php

namespace App\Filament\Resources\RubriqueResource\Pages;

use App\Filament\Resources\CategorieResource\Pages\ListCategories;
use App\Filament\Resources\RubriqueResource;

class ListRubriques extends ListCategories
{
    protected static string $resource = RubriqueResource::class;
}
