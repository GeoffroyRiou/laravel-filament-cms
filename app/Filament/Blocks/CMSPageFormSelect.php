<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Select;

class CMSPageFormSelect extends Select
{
    public function generateOptions(string $model): self
    {
        $this->options(function () use ($model) {
            return $model::get()->pluck('titre', 'id');
        });

        return $this;
    }
}
