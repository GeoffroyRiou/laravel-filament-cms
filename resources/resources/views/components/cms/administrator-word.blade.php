@props(['data' => []])

@php
    $photo = $data['image'] ? imageUrl($data['image'], 150, 150) : null;
    $signature = $data['signature'] ? imageUrl($data['signature'], 150, crop: false) : null;
@endphp

<section class="cms-administrator-word">
    <div class="inner">
        <x-front.title-lvl2 :darkText="$data['title']" class="-always-centered" />

        <div class="text">
            {!! $data['text'] !!}
        </div>

        <div class="cms-administrator-word__signature">
            @if (!empty($photo))
                <img loading="lazy" src="{{ $photo }}" alt="" class="photo" />
            @endif
            <div class="text">
                <p class="name">{{ $data['name'] }}</p>
                <p class="role">{{ $data['role'] }}</p>
            </div>
            @if (!empty($signature))
                <img loading="lazy" src="{{ $signature }}" alt="" class="signature" />
            @endif
        </div>
    </div>
</section>
