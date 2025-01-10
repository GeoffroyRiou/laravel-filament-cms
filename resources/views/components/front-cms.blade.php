<div class="cms-wrapper">
    @foreach ($blocks as $block)
        @switch($block->type)
            @case('titre')
                <div class="cms-default">
                    <{{ $block->niveau }}>
                        {{ $block->texte }}
                        </{{ $block->niveau }}>
                </div>
            @break

            @case('image')
                <img src="{{ $block->media->getFirstMediaUrl('media_files', 'thumbnail') }}" alt="{{ $block->media->nom }}"
                    class="w-20">
            @break

            @case('fichier')
                <a href="{{ $block->media->getFirstMediaUrl('media_files') }}">Télécharger :
                    {{ $block->media->nom }}</a>
            @break

            @case('formulaire')
                @livewire('contact-form', ['formId' => $block->contenu])
            @break

            @default
                <div class="cms-default">
                    {!! $block->contenu ?? '' !!}
                </div>
        @endswitch
    @endforeach

</div>
