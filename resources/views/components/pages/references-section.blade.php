@props(['titre' => '', 'references' => [], 'isAutres' => false])

<section class="references-section">
    <div class="inner">
        <div class="references-section__header {{ $isAutres ? '-autres' : '' }}">
            <h2 class="titre">
                {{ $titre ?: pluralize('Référence',count($references)) }}
                @if (!$isAutres)
                    {!! svgIcon('etoile-vide') !!}
                @endif
            </h2>
            @if (!$isAutres)
                <x-front-button-lvl3 texte="Tous les projets" :lien="getPostUrl(12)" icon="arrow-lien"
                    modificators="-hover-jaune" />
            @endif
        </div>
        <div class="references-section__references">
            @foreach ($references as $refIndex => $reference)
                @if (!empty($reference))
                    <x-front-reference-card :reference="$reference" modificators="card {{ $refIndex ? '-small' : '' }}" />
                @endif
            @endforeach
        </div>
    </div>
</section>
