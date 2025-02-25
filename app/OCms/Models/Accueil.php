<?php

namespace App\OCms\Models;

use App\OCms\Models\Scopes\PostScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([new PostScope()])]
class Accueil extends Post {}
