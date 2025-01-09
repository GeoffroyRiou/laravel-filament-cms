<?php

namespace App\Models;

use App\Models\Scopes\PostScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([new PostScope()])]
class Accueil extends Post
{   
}
