<?php

namespace App\OCms\Livewire;

use App\OCms\Models\MediaLibraryFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Modelable;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class MediaLibraryFilePicker extends Component
{

    use WithPagination, WithoutUrlPagination;

    public bool $imagesOnly = false;

    public bool $filesOnly = false;

    public int | string $perPage = 10;


    #[Modelable] // Lien avec la propriété wire:model à l'appel du composant
    public ?string $mediaFileId = '';


    public function selectMediaFile(string $mediaFileId): void
    {
        $this->mediaFileId = $mediaFileId;
    }


    public function getMediaFiles(): LengthAwarePaginator
    {
        $medias = MediaLibraryFile::paginate($this->perPage);

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
