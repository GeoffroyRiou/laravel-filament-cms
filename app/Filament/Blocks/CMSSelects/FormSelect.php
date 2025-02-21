<?php

namespace App\Filament\Blocks\CMSSelects;

use App\Models\ContactForm;
use Filament\Forms\Components\Select;

class FormSelect extends Select
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->options(function () {
            $options = [];
            foreach (ContactForm::all() as $form) {
                $options[$form->id] = $form->nom;
            }

            return $options;
        });
    }
}
