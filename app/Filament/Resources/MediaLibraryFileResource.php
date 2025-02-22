<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaLibraryFileResource\Pages;
use App\Filament\Resources\MediaLibraryFileResource\RelationManagers;
use App\Models\MediaLibraryFile;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MediaLibraryFileResource extends Resource
{
    protected static ?string $model = MediaLibraryFile::class;

    protected static ?string $modelLabel = 'Bibliothèque de médias';

    protected static ?string $navigationGroup = 'Media';

    protected static ?string $navigationLabel = 'Bibliothèque de médias';

    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('path')
                    ->label('Fichier')
                    ->required(),
                TextInput::make('name')->label('Nom')->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Grid::make()
                    ->columns(1)
                    ->schema([
                        ImageColumn::make('path')
                            ->label('Image')
                            ->square(true)
                            ->height(150),
                        TextColumn::make('name')
                            ->label('Nom')
                            ->searchable(),
                    ])
            ])
            ->contentGrid(['sm' => 2, 'md' => 3, 'lg' => 4])
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMediaLibraryFiles::route('/'),
        ];
    }
}
