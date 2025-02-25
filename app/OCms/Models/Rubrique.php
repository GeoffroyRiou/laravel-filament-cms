<?php

namespace App\OCms\Models;

use App\OCms\Models\Scopes\CategorieScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([new CategorieScope()])]
class Rubrique extends Categorie
{
    protected $postModel = Page::class;
    public static string $routeSlug = 'rubrique';
}
