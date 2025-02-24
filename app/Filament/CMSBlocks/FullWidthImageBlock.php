<?php

namespace App\Filament\CMSBlocks;

use App\Filament\CMSSchemas\ImageSchema;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\TextInput;

class FullWidthImageBlock
{
    public static function make(): Block
    {
        return Block::make('cms-blocks.full-width-image')
            ->label('Image pleine largeur')
            ->icon('heroicon-o-photo')
            ->schema(ImageSchema::get());
    }
}
