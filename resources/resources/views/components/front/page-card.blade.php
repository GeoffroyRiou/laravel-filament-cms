@props(['data' => [], 'isAlone' => false])


@php
    $image = $data['image'] ?? null;
    $w = 865;
    $h = 585;
    if($isAlone) {
        $w = 1980;
        $h = 600;
    }
    $imageUrlBig = $image ? imageUrl($image, $w, $h) : '';
    $imageUrlSmall = $image ? imageUrl($image, 430, 450) : '';
    
    $boutonPage = $allPages->where('id', $data['bouton_page'])->first();
    $format = $data['format'] ?? '';
@endphp

<div class="cms-page-card {{ $format ? '-'.$format : '' }}">
    @if(!empty($image))
        <picture class="cms-page-card__image">
            <source srcset="{{ $imageUrlSmall }}" media="(max-width: 768px)">
            <source srcset="{{ $imageUrlBig }}" media="(min-width: 768px)">
            <img loading="lazy" src="{{ $imageUrlSmall }}" alt="" class="picture" />
        </picture>
    @endif
    <div class="cms-page-card__content">
        <x-front.title-lvl2 :lightText="$data['title'] ?? ''" class="title -over-{{ $format }} -always-centered"/>
        <p class="text">
            {{ $data['text'] ?? '' }}
        </p>
        @if (!empty($boutonPage))
            <x-front.button :label="$data['bouton_text'] ?? $boutonPage->titre" :link="$boutonPage->getUrl()" class="{{$data['bouton_style']}} -fit" />
        @endif
    </div>
</div>
