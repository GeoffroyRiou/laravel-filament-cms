<?php

namespace App\OCms\Resources\RubriqueResource\Pages;

use App\OCms\Resources\CategorieResource\Pages\ListCategories;
use App\OCms\Resources\RubriqueResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRubriques extends ListCategories
{
    protected static string $resource = RubriqueResource::class;
}
