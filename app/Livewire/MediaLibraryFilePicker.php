<?php

namespace App\Livewire;

use App\Models\MediaLibraryFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class MediaLibraryFilePicker extends Component
{

    use WithPagination;

    public bool $imagesOnly = false;

    public bool $filesOnly = false;

    public string $mediaFileId = '';


    public function selectMediaFile(string $mediaFileId): void
    {
        $this->mediaFileId = $mediaFileId;

        $this->dispatch('media-file-selected', $mediaFileId);
    }


    public function getMediaFiles(): LengthAwarePaginator
    {
        $medias = MediaLibraryFile::paginate(3);

        /*$medias = $medias->filter(function (MediaLibraryFile $media) {
            return (
                (! $this->imagesOnly && ! $this->filesOnly) || // Pas de limitations
                ($this->imagesOnly && $media->isImage()) || // image seulement
                ($this->filesOnly && ! $media->isImage())     // fichier seulement
            );
        });*/

        return $medias;
    }
    public function render()
    {
        return view('livewire.media-library-file-picker', [
            'mediaFiles' => $this->getMediaFiles()
        ]);
    }
}
