<?php

namespace App\Livewire;

use App\Mail\ContactFormMail;
use App\Models\ContactForm as ContactFormModel;
use App\Models\ContactFormEntry;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;

class ContactForm extends Component
{
    use WithFileUploads;

    public array $rules;

    public ContactFormModel $form;

    public array $formData = [];

    public bool $formSent = false;

    public bool $sendingError = false;

    public function mount(int $formId): void
    {
        $this->form = ContactFormModel::findOrFail($formId);
        $this->prepareForm();
    }

    /**
     * Rempli les propriétés du composant en fonction des champs du formulaire
     */
    private function prepareForm(): void
    {
        foreach ($this->form->champs as $block) {
            switch ($block['type']) {
                case 'choix':
                    switch ($block['data']['type']) {
                        case 'checkbox':
                            $this->formData[$block['data']['slug']] = [];
                            break;
                            // On défini la valeur sélectionnée comme étant la première disponible
                        case 'select':
                            $valeurs = array_keys($block['data']['valeurs']) ?? [];
                            $this->formData[$block['data']['slug']] = $valeurs[0] ?? '';
                            break;
                        default:
                            $this->formData[$block['data']['slug']] = '';
                            break;
                    }
                    break;
                default:
                    $this->formData[$block['data']['slug']] = '';
                    break;
            }
        }
    }

    public function getRules(): array
    {
        $rules = [];
        foreach ($this->form->champs as $champ) {
            $ruleStr = '';

            if ($champ['data']['requis']) {
                $ruleStr = 'required';
            }

            switch ($champ['type']) {
                case 'fichier':
                    $format = $champ['data']['format'] ?: null;
                    if (! empty($format)) {
                        $ruleStr .= "|extensions:{$format}";
                    }
                    break;
            }
            $rules['formData.'.$champ['data']['slug']] = trim($ruleStr, '|');
        }

        return $rules;
    }

    public function send(): void
    {
        $validated = $this->validate($this->getRules());
        $this->sendingError = false;

        $formattedData = $this->formatDataForMail($validated['formData']);

        // Création de l'entrée en base

        ContactFormEntry::create([
            'champs' => json_encode($formattedData),
            'sujet' => $this->form->sujet,
            'destinataires' => $this->form->destinataires,
            'formulaire' => $this->form->nom,
        ]);

        // Envoi du mail
        if (
            Mail::to(explode(',', $this->form->destinataires))
                ->send(
                    new ContactFormMail(
                        $this->form->sujet ?? '',
                        $formattedData
                    )
                )
        ) {
            $this->formSent = true;
        } else {
            $this->sendingError = true;
        }
    }

    /**
     * Génère les données pour le mail sous la forme de
     * label => valeur
     */
    private function formatDataForMail(array $validatedData): array
    {
        $mailData = [
            'champs' => [],
            'fichiers' => [],
        ];

        foreach ($validatedData as $key => $value) {
            $champInformations = $this->form->getFieldInformations($key);

            if ($champInformations) {

                if ($champInformations['type'] === 'fichier') {
                    $mailData['fichiers'][] = $value->getRealPath();
                } else {

                    if ($value == '0') {
                        $value = 'non';
                    }
                    if ($value == '1') {
                        $value = 'oui';
                    }

                    $mailData['champs'][$champInformations['data']['label'] ?? $key] = $value;
                }
            }
        }

        return $mailData;
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
