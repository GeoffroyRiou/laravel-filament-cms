<?php

namespace App\OCms\Pages;

use App\OCms\Models\Settings;
use Filament\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;

class Parametres extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $title = 'Paramètres';

    protected static ?string $navigationGroup = 'Configuration';

    protected static string $view = 'filament.pages.parametres';

    protected static ?string $navigationLabel = 'Options du site';

    protected static ?int $navigationSort = 6;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(Settings::first()->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Coordonnées')
                    ->schema([
                        TextInput::make('telephone'),
                        TextInput::make('adresse'),
                        TextInput::make('email'),
                    ]),

                Section::make('Réseaux')
                    ->schema([
                        TextInput::make('facebook'),
                        TextInput::make('linkedin'),
                        TextInput::make('x'),
                        TextInput::make('instagram'),
                    ]),

                Section::make('Analytics')
                    ->schema([
                        TextInput::make('gtag')->label('Code GA'),
                        TextInput::make('matomo')->label('ID du site Matomo'),
                    ]),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();
            $settings = Settings::first();

            $settings->update($data);
        } catch (Halt $exception) {
            return;
        }

        Notification::make()
            ->success()
            ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'))
            ->send();
    }
}
