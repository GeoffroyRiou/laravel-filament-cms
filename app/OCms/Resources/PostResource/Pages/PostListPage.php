<?php

namespace App\OCms\Resources\PostResource\Pages;

use App\OCms\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class PostListPage extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
