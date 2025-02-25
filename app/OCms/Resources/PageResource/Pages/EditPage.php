<?php

namespace App\OCms\Resources\PageResource\Pages;

use App\OCms\Resources\PageResource;
use App\OCms\Resources\PostResource\Pages\PostEditPage;

class EditPage extends PostEditPage
{
    protected static string $resource = PageResource::class;
}
