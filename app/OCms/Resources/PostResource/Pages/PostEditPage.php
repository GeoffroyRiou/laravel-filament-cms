<?php

namespace App\OCms\Resources\PostResource\Pages;

use App\OCms\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class PostEditPage extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = PostResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['slug'] = $data['slug'] ?: Str::slug($data['titre']);

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
