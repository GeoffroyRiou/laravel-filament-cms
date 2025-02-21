<?php

namespace App\Filament\Blocks;

use App\Forms\Components\MediaFileField;
use App\Models\Page;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Get;

class CMSField extends Builder
{
    /**
     * Configure le schéma du formulaire pour le CMSField.
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
        $schemaPath = app_path('Filament/Blocks/CMSBlocks');
        
        foreach (glob("{$schemaPath}/*.php") as $file) {
            $className = 'App\\Filament\\Blocks\\CMSBlocks\\' . basename($file, '.php');
            if (class_exists($className) && method_exists($className, 'make')) {
                $schemas[] = $className::make();
            }
        }

        return $schemas;
    }

}
