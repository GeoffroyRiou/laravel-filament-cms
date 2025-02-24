<?php

namespace App\Livewire\CMS;

use App\Models\MediaLibraryFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Modelable;
use Livewire\Component;
use Livewire\WithPagination;

class MediaLibraryFilePicker extends Component
{

    use WithPagination;

    public bool $imagesOnly = false;

    public bool $filesOnly = false;

    #[Modelable] // Lien avec la propriété wire:model à l'appel du composant
    public string $mediaFileId = '';


    public function selectMediaFile(string $mediaFileId): void
    {
        $this->mediaFileId = $mediaFileId;
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
        return view('livewire.cms.media-library-file-picker', [
            'mediaFiles' => $this->getMediaFiles()
        ]);
    }
}
