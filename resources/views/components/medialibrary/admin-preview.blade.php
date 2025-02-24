@props(['mediaFile'])

<figure {{ $attributes->merge(['class' => 'media-library__card']) }}>
    <div class="preview">
        @if ($mediaFile->isImage())
            <img src="{{ $mediaFile->getUrl(150, 150) }}" alt="{{ $mediaFile->name }}" class="thumbnail">
        @else
            @svg('heroicon-o-document')
        @endif
    </div>
    <span class="caption">{{ $mediaFile->name }}</span>
</figure>
