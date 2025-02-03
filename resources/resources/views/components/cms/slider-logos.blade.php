@props(['data' => []])
@php
    $logos = $data['logos'] ?? [];
@endphp

<section class="cms-slider-logos">
    <div class="head">
        <x-front.title-lvl2 :darkText="$data['title'] ?? ''" class="-always-centered" />
    </div>

    <div class="cms-slider-logos__slider">
        <div class="swiper-wrapper">
            @foreach ($logos as $logo)
                <div class="cms-slider-logos__logo swiper-slide">
                    <x-front.logo-card :logo="$logo" />
                </div>
            @endforeach
        </div>
    </div>
</section>
