<?php

namespace App\Filament\CMSFields;

use Filament\Forms\Components\Select;

class PostSelect extends Select
{
    public function generateOptions(string $model): self
    {
        $this->options(function () use ($model) {
            return $model::get()->pluck('titre', 'id');
        });

        return $this;
    }
}
