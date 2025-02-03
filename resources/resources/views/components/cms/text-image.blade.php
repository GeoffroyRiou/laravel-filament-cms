@props(['data' => []])


@php
    $imageUrl = $data['image'] ? imageUrl($data['image'],800,700) : null;
    $boutonPage = $allPages->where('id', $data['bouton_page'])->first();
    $imageFullClass = $data['image_full'] ? '-imagefull' : '';
    $reverseClass = $data['image_right'] ? '-reverse' : '';
    $bgColorClass = $data['bgTextColor'] ? '-'.$data['bgTextColor'] : '';
    $lightText = $data['title_light'];
    $darkText = $data['title_dark'];
@endphp

<section class="cms-text-image {{ $bgColorClass }}">
    <div class="inner {{ $imageFullClass }}">
        @if (!empty($imageUrl))
            <figure class="cms-text-image__image {{ $imageFullClass }} {{ $reverseClass }}">
                <img loading="lazy" src="{{ $imageUrl }}" alt="" class="picture" />
            </figure>
        @endif
        <div class="cms-text-image__content {{ $imageFullClass }} {{ $reverseClass }} {{ $bgColorClass }}">
            <x-front.title-lvl2 :lightText="$lightText" :darkText="$darkText" class="title -over{{ $bgColorClass }}"/>

            <div class="text {{ '-over'.$bgColorClass}}">
                {!! $data['text'] ?? '' !!}
            </div>
            @if (!empty($boutonPage))
                <x-front.button :label="$data['bouton_text'] ?? $boutonPage->titre" :link="$boutonPage->getUrl()" :class="'button ' . ($data['bouton_style'] ?? '')" />
            @endif
        </div>
    </div>
</section>
