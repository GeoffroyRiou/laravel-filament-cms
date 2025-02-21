<?php

namespace App\Livewire;

use App\Models\MediaLibraryFile;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class MediaFilePreview extends Component implements HasForms, HasActions
{

    use InteractsWithActions;
    use InteractsWithForms;

    public ?MediaLibraryFile $mediaFile = null;

    public function mount(string $mediaFileId): void
    {
        $this->mediaFile = MediaLibraryFile::find($mediaFileId);
    }



    public function editAction(): Action
    {
        return EditAction::make()
            ->record($this->mediaFile)
            ->icon('heroicon-o-pencil-square')
            ->form($this->getFormSchema())
            ->iconButton();
    }

    public function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->required()
                ->columnSpan(2),
            FileUpload::make('path')
                ->required()
                ->columnSpan(2),
        ];
    }

    public function render()
    {
        return view('livewire.media-file-preview');
    }
}
