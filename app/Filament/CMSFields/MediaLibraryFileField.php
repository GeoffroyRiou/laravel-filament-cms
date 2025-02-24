<?php

namespace App\Filament\CMSFields;

use App\Models\MediaLibraryFile;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;

class MediaLibraryFileField extends Field
{
    protected string $view = 'forms.components.media-file-field';

    public bool $imagesOnly = false;

    public bool $filesOnly = false;

    public ?int $maxSize = 5 * 1024;

    protected function setUp(): void
    {
        parent::setUp();

        $this->registerActions([
            fn(self $component): Action => $component->getPickerAction(),
            fn(self $component): Action => $component->getUploadAction(),
        ]);
    }

    public function imagesOnly(bool $imagesOnly = false): static
    {
        $this->imagesOnly = $imagesOnly;

        return $this;
    }

    public function filesOnly(bool $filesOnly = false): static
    {
        $this->filesOnly = $filesOnly;

        return $this;
    }

    public function maxSize(int $maxSize): static
    {
        $this->maxSize = $maxSize;

        return $this;
    }

    public function getMediaFile(): ?MediaLibraryFile
    {
        $state = $this->getState();

        if (! $state) {
            return null;
        }

        return MediaLibraryFile::find($state);
    }

    public function getPickerAction(): Action
    {
        return Action::make('picker')
            ->label('Sélectionner un fichier')
            ->icon('heroicon-o-photo')
            ->form([
                MediaLibraryFilePicker::make('file')
                    ->imagesOnly($this->imagesOnly)
                    ->filesOnly($this->filesOnly),
            ])
            ->fillForm(fn(Component $component): array => [
                'file' => $component->getState(),
            ])
            ->action(function (array $data, Set $set, Component $component) {
                $set(
                    $component->getStatePath(false),
                    $data['file'][0]
                );
            });
    }

    public function getUploadAction(): Action
    {
        return Action::make('upload')
            ->label('Téléverser un fichier')
            ->icon('heroicon-o-photo')
            ->form([
                TextInput::make('name')
                    ->required()
                    ->columnSpan(2),
                FileUpload::make('path')
                    ->label('Fichier')
                    ->required()
                    ->maxSize($this->maxSize),
            ])
            ->action(function (array $data, Set $set, Component $component) {
                $newMedia = MediaLibraryFile::create([
                    'name' => $data['name'],
                    'path' => $data['path'],
                ]);

                $set(
                    $component->getStatePath(false),
                    $newMedia->id
                );
            });
    }
}
