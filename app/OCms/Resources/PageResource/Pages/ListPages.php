<?php

namespace App\OCms\Resources\PageResource\Pages;

use App\OCms\Resources\PageResource;
use App\OCms\Resources\PostResource\Pages\PostListPage;

class ListPages extends PostListPage
{
    protected static string $resource = PageResource::class;
}
