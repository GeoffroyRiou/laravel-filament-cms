<?php

namespace App\OCms\Resources\RubriqueResource\Pages;

use App\OCms\Resources\CategorieResource\Pages\CategorieEdit;
use App\OCms\Resources\RubriqueResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRubrique extends CategorieEdit
{
    protected static string $resource = RubriqueResource::class;
}
