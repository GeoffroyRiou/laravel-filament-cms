<?php

namespace App\Models;

use App\Models\Scopes\PostScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([new PostScope()])]
class Page extends Post
{

    protected $categorieModel = Rubrique::class;
    public static string $routeSlug = 'page';
}
