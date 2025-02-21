<?php

namespace App\Filament\Blocks\CMSBlocks;

use App\Filament\Blocks\CMSSchemas\ImageSchema;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\TextInput;

class SimpleImageBlock
{
    public static function make(): Block
    {
        return Block::make('cms.simple-image')
            ->label('Image pleine largeur')
            ->icon('heroicon-o-photo')
            ->schema(ImageSchema::get());
    }
}
