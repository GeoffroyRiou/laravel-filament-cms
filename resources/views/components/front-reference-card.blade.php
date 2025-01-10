@props(['reference', 'modificators' => '', 'titreTag' => 'h3'])
@php
    $imagesfield = $reference->field('images');
    $media = !empty($imagesfield) ? getMediaFile($imagesfield[0]['image']) : null;
@endphp

<a href="{{ $reference->getUrl() }}" class="reference-card {{ $modificators }}"
    @if ($media) style="--bg-big: url('{{ getMediaFileUrl($media, 'reference-big') }}');
        --bg-small: url('{{ getMediaFileUrl($media, 'reference-small') }}');
        --bg-mobile: url('{{ getMediaFileUrl($media, 'reference-mobile') }}');" @endif>
    <div class="content">
        <p class="head">{{$reference->field('annee')}} &bull; {{$reference->field('client') }}</p>
        <{{ $titreTag }} class="titre">{{ $reference->titre }}</{{ $titreTag }}>
        <div class="reference-card__tags">
            @foreach ($reference->tags as $tag)
                <span class="tag-item">{{ $tag->nom }}</span>
            @endforeach
        </div>
    </div>
</a>
