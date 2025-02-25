<?php

namespace App\OCms\Resources\PageResource\Pages;

use App\OCms\Resources\PageResource;
use App\OCms\Resources\PostResource\Pages\PostCreatePage;

class CreatePage extends PostCreatePage
{
    protected static string $resource = PageResource::class;
}
