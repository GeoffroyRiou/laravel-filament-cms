<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ArticlesList extends Component
{
    public Collection $articles;
    public Collection $filteredArticles;
    public Collection $categories;
    public string $currentFilter = 'all';
    public int $perPage = 6;
    public int $loadedCount = 0;

    public function mount(Collection $articles, Collection $categories)
    {
        $this->articles = $articles;
        $this->categories = $categories;
        $this->loadArticles();
    }

    public function loadMore(): void
    {
        $this->loadedCount += $this->perPage;
        $this->loadArticles();
    }

    private function loadArticles(): void 
    {
        if ($this->currentFilter === 'all') {
            $this->filteredArticles = $this->articles->take($this->loadedCount + $this->perPage);
            return;
        }

        $this->filteredArticles = $this->articles
            ->filter(fn($article) => $article->categories->pluck('id')->contains($this->currentFilter))
            ->take($this->loadedCount + $this->perPage)
            ->values();
    }

    public function filter(string $filter): void
    {
        $this->currentFilter = $filter;
        $this->loadedCount = 0;
        $this->loadArticles();
    }

    public function hasMorePages(): bool
    {
        return $this->filteredArticles->count() < $this->articles->count();
    }

    public function render()
    {
        return view('livewire.articles-list');
    }
}
