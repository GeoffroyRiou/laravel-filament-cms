<?php

namespace App\Filament\Resources\RubriqueResource\Pages;

use App\Filament\Resources\CategorieResource\Pages\CategorieEdit;
use App\Filament\Resources\RubriqueResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRubrique extends CategorieEdit
{
    protected static string $resource = RubriqueResource::class;
}
