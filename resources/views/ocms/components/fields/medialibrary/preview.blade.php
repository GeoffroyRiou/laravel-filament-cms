@props(['mediaFile', 'hideCaption' => false])

<figure {{ $attributes->merge(['class' => 'media-library__card']) }}>
    <div class="preview">
        @if ($mediaFile->is_image)
            <img src="{{ $mediaFile->getUrl(100, 100) }}" alt="{{ $mediaFile->name }}" class="thumbnail">
        @else
            @svg('heroicon-o-document')
        @endif
    </div>
    @if (!$hideCaption)
        <span class="caption">{{ $mediaFile->name }}</span>
    @endif
</figure>
