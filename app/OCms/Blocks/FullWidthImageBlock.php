<?php

namespace App\OCms\Blocks;

use App\OCms\Schemas\ImageSchema;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\TextInput;

class FullWidthImageBlock
{
    public static function make(): Block
    {
        return Block::make('ocms::full-width-image')
            ->label('Image pleine largeur')
            ->icon('heroicon-o-photo')
            ->schema(ImageSchema::get());
    }
}
