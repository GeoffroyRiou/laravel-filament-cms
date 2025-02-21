<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaLibraryFileResource\Pages;
use App\Models\MediaLibraryFile;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MediaLibraryFileResource extends Resource
{
    protected static ?string $model = MediaLibraryFile::class;

    protected static ?string $modelLabel = 'Média';

    protected static ?string $navigationGroup = 'Divers';

    protected static ?string $navigationLabel = 'Bibliothèque de médias';

    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\MediaLibraryPage::route('/'),
            'create' => Pages\CreateMediaLibraryFile::route('/create'),
            'edit' => Pages\EditMediaLibraryFile::route('/{record}/edit'),
        ];
    }
}
