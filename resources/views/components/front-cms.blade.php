<div class="flex flex-col gap-5">
    @foreach ($blocks as $block)
        @switch($block->type)
            @case('titre')
                <{{ $block->niveau }} class="text-xl">
                    {{ $block->texte }}
                    </{{ $block->niveau }}>
                @break

                @case('image')
                    <img src="{{ $block->media->getFirstMediaUrl('media_files', 'thumbnail') }}" alt="{{ $block->media->nom }}"
                        class="w-20">
                @break

                @case('fichier')
                    <a href="{{ $block->media->getFirstMediaUrl('media_files') }}" class="border p-1 rounded-lg">Télécharger :
                        {{ $block->media->nom }}</a>
                @break

                @case('formulaire')
                    @livewire('contact-form', ['formId' => $block->contenu])
                @break

                @default
                    <div>
                        {!! $block->contenu !!}
                    </div>
            @endswitch
    @endforeach
</div>
