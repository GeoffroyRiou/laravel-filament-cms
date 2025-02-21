<?php

namespace App\Filament\Blocks\CMSBlocks;

use App\Filament\Blocks\CMSSchemas\ComplexButtonSchema;
use App\Filament\Blocks\CMSSchemas\PostButtonSchema;
use App\Filament\Blocks\CMSSelects\IconSelect;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Get;

class SimpleButtonBlock
{
    public static function make(): Block
    {
        return Block::make('cms.simple-button')
            ->label('Bouton')
            ->icon('heroicon-o-link')
            ->schema(ComplexButtonSchema::get());
    }
}
