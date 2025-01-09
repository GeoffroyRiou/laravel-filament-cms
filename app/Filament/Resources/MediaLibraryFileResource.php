<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaLibraryFileResource\Pages;
use App\Models\MediaLibraryFile;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
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
            ->schema([
                TextInput::make('nom')
                    ->required()
                    ->columnSpan(2),
                SpatieMediaLibraryFileUpload::make('file')
                    ->collection('media_files')->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('file')
                    ->collection('media_files')
                    ->conversion('thumbnail')
                    ->circular(),
                TextColumn::make('nom'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListMediaLibraryFiles::route('/'),
            'create' => Pages\CreateMediaLibraryFile::route('/create'),
            'edit' => Pages\EditMediaLibraryFile::route('/{record}/edit'),
        ];
    }
}
