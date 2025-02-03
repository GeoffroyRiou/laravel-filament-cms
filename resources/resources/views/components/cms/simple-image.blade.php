@props(['data' => []])

@php
    $imageUrlSmall = $data['image'] ? imageUrl($data['image'],640,360) : null;
    $imageUrl = $data['image'] ? imageUrl($data['image'],1000,565) : null;
@endphp

<section class="g-container-small">
    <picture>
        <source srcset="{{ $imageUrl }}" media="(max-width: 639px)">
        <source srcset="{{ $imageUrl }}" media="(min-width: 640px)">
        <img src="{{ $imageUrlSmall }}" alt="{{ $data['alt'] }}" loading="lazy" />
    </picture>
</section>