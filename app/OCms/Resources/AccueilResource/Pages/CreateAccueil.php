<?php

namespace App\OCms\Resources\AccueilResource\Pages;

use App\OCms\Resources\AccueilResource;
use App\OCms\Resources\PostResource\Pages\PostCreatePage;

class CreateAccueil extends PostCreatePage
{
    protected static string $resource = AccueilResource::class;
}
