<?php

namespace App\Forms\Components;

use App\Models\MediaLibraryFile;
use Filament\Forms\Components\Field;
use Illuminate\Database\Eloquent\Collection;

class MediaFilePicker extends Field
{
    protected string $view = 'forms.components.media-file-picker';

    public bool $imagesOnly = false;

    public bool $filesOnly = false;

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

    public function getMediaFiles(): Collection
    {
        $medias = MediaLibraryFile::all();

        $medias = $medias->filter(function (MediaLibraryFile $media) {
            return (
                (! $this->imagesOnly && ! $this->filesOnly) || // Pas de limitations
                ($this->imagesOnly && $media->isImage()) || // image seulement
                ($this->filesOnly && ! $media->isImage())     // fichier seulement
            );
        });

        return $medias;
    }
}
