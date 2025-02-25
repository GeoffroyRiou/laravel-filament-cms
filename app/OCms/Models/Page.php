<?php

namespace App\OCms\Models;

use App\OCms\Models\Scopes\PostScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([new PostScope()])]
class Page extends Post
{

    protected $categorieModel = Rubrique::class;
    public static string $routeSlug = 'page';
}
