@props(['data' => []])

@php
    $imageUrl = $data['image'] ? imageUrl($data['image'],800,700) : null;
    $lightText = $data['title_light'];
    $darkText = $data['title_dark'];
    $reverseClass = $data['image_right'] ? '-reverse' : '';
    $paragraphes = $data['paragraphs'] ?? [];
@endphp

<section class="cms-job-section">
    <div class="cms-job-section__content {{ $reverseClass }}">
        <div class="inner">
            <x-front.title-lvl2 :lightText="$lightText" :darkText="$darkText" class="-always-centered"/>

            <div class="cms-job-section__paragraphs">
                @foreach ($paragraphes as $paragraph)
                    <p class="title -{{ $paragraph['labelColor'] }}">
                        {{ $paragraph['label'] }}
                    </p>
                    <div class="text">
                        {!! $paragraph['text'] !!}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @if (!empty($imageUrl))
        <figure class="cms-job-section____image {{ $reverseClass }}">
            <img loading="lazy" src="{{ $imageUrl }}" alt="" class="picture" />

            {!! svgIcon('grid', 'grid') !!}
        </figure>
    @endif
</section>
