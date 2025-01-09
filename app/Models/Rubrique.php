<?php

namespace App\Models;

use App\Models\Scopes\CategorieScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([new CategorieScope])]
class Rubrique extends Categorie
{
    protected $postModel = Page::class;
}
