<div class="articles-list">
    <div class="articles-list__filters">
        <div class="head">
            {!! svgIcon('filter') !!}
            <p class="label">Filtrer par thématiques :</p>
        </div>
        <div class="filters">
            <button wire:click.prevent="filter('all')"
                class="articles-list__filters__filter {{ $currentFilter === 'all' ? '-active' : '' }}">
                Toutes
            </button>

            @foreach ($categories as $categorie)
                <button wire:click.prevent="filter({{ $categorie->id }})"
                    class="articles-list__filters__filter {{ $currentFilter == $categorie->id ? '-active' : '' }}">
                    {{ $categorie->nom }}
                </button>
            @endforeach
        </div>

        <button wire:click.prevent="filter('all')" class="articles-list__filters__reset">
            Réinitialiser
        </button>
    </div>

    <div class="articles-list__articles">
        @if (!count($filteredArticles))
            <p class="empty">Aucun article dans cette categorie.</p>
        @else
            @foreach ($filteredArticles as $artIndex => $article)
                <x-front.article-card :article="$article" />
            @endforeach
        @endif
    </div>

    @if ($this->hasMorePages())
        <div class="articles-list__more">
            <button wire:click="loadMore" class="g-button -main-l -fit">
                Voir plus d'articles
            </button>
        </div>
    @endif
</div>
