<?php

namespace App\OCms\Resources\CategorieResource\Pages;

use App\OCms\Resources\CategorieResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CategorieCreate extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = CategorieResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug'] = $data['slug'] ?: Str::slug($data['nom']);

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
