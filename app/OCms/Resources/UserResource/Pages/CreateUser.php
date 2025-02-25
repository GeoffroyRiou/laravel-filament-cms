<?php

namespace App\OCms\Resources\UserResource\Pages;

use App\OCms\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
