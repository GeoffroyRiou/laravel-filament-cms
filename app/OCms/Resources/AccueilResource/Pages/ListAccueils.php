<?php

namespace App\OCms\Resources\AccueilResource\Pages;

use App\OCms\Resources\AccueilResource;
use App\OCms\Resources\PostResource\Pages\PostListPage;

class ListAccueils extends PostListPage
{
    protected static string $resource = AccueilResource::class;
}
