<?php

namespace App\Livewire;

use App\Models\MediaLibraryFile;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class MediaLibrary extends Component implements HasForms, HasActions
{

    use InteractsWithActions;
    use InteractsWithForms;


    private function getHeaderActions(): array
    {
        return [
            $this->createAction(),
        ];
    }

    public function createAction(): Action
    {
        return CreateAction::make()
            ->model(MediaLibraryFile::class)
            ->label('Ajouter un média')
            ->icon('heroicon-o-plus')
            ->form($this->getFormSchema())
            ->button();
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
        return view('livewire.media-library', [
            'medias' => MediaLibraryFile::all(),
            'headerActions' => $this->getHeaderActions(),
        ]);
    }
}
