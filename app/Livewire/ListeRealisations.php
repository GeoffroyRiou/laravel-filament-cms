<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;

class ListeRealisations extends Component
{

    public Collection $references;
    public Collection $filteredReferences;
    public Collection $rubriques;

    public string $currentFilter = 'all';

    public function mount(Collection $references, Collection $rubriques)
    {
        $this->references = $this->filteredReferences = $references;
        $this->rubriques = $rubriques;
    }

    public function filter(string $filter): void
    {

        $this->currentFilter = $filter;

        if ($filter === 'all') {
            $this->filteredReferences = $this->references;
            return;
        }

        $this->filteredReferences = $this->references->filter(function ($reference) use ($filter) {
            return $reference->categories
                ->pluck('id')
                ->contains($filter);
        })->values(); // Le values permet de regénérer les indexs dans le bon ordre
    }

    public function render()
    {
        return view('livewire.liste-realisations');
    }
}
