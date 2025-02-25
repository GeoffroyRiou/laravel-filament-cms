<?php

namespace App\OCms\Fields;

use App\OCms\Enums\Icons;
use Filament\Forms\Components\Select;

class IconSelect extends Select
{
    public function generateOptions(): self
    {
        $this->options(getAllEnumValues(Icons::cases()));

        return $this;
    }
}
