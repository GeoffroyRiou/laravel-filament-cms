<?php

namespace App\Filament\Blocks;

use App\Models\ContactForm;
use Filament\Forms\Components\Select;

class ContactFormSelect extends Select
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
