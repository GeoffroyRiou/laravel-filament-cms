<?php

namespace App\Filament\CMSFields;

use Filament\Forms\Components\Builder;

class PageBuilder extends Builder
{
    /**
     * Configure le schéma du formulaire pour le PageBuilder.
     *
     * Cette méthode initialise le schéma du formulaire en ajoutant divers composants
     * tels que des champs de texte, des champs de sélection, un éditeur enrichi, des
     * interrupteurs de basculement et des répétiteurs. Le schéma est défini en utilisant
     * la classe Builder\Block et ses composants de schéma correspondants.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->label('')
            ->addActionLabel('Ajouter un bloc')
            ->blockNumbers(false)
            ->blockPickerColumns(3)
            ->schema($this->loadCustomBlocks());
    }

    protected function loadCustomBlocks(): array
    {
        $schemas = [];
        $schemaPath = app_path('Filament/CMSBlocks');

        foreach (glob("{$schemaPath}/*.php") as $file) {
            $className = 'App\\Filament\\CMSBlocks\\' . basename($file, '.php');
            if (class_exists($className) && method_exists($className, 'make')) {
                $schemas[] = $className::make();
            }
        }

        return $schemas;
    }
}
