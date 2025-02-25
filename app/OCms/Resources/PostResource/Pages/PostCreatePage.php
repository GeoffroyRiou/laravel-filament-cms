<?php

namespace App\OCms\Resources\PostResource\Pages;

use App\OCms\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class PostCreatePage extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = PostResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug'] = $data['slug'] ?: Str::slug($data['titre']);

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
