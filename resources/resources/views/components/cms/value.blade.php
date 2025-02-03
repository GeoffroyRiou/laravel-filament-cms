@props(['data' => []])


@php
    $imageUrl = $data['image'] ? imageUrl($data['image'], 100, 100) : null;
    $reverseClass = $data['reverse'] ? '-reverse' : '';
    $bgTextColorClass = $data['bgTextColor'] ? '-' . $data['bgTextColor'] : '';
    $bgTestimonyColor = $data['bgTestimonyColor'] ? '-' . $data['bgTestimonyColor'] : '';
@endphp

<section class="cms-value {{ $bgTextColorClass }} {{ $reverseClass }}">
    <div class="cms-value__content">
        <div class="inner">
            <x-front.title-lvl2 :darkText="$data['title']" class="title -over{{ $bgTextColorClass }}" />

            <div class="text {{ '-over' . $bgTextColorClass }}">
                {!! $data['text'] ?? '' !!}
            </div>
        </div>
    </div>
    <div class="cms-value__testimony {{ $bgTestimonyColor }}">
        <div class="testimony-card">
            <div class="inner">
                <div class="testimony-card__text">
                    {!! $data['testimony'] !!}
                </div>
                <div class="testimony-card__head">
        
                    @if (!empty($imageUrl))
                        <img loading="lazy" src="{{ $imageUrl }}" alt="" class="picture" />
                    @endif
        
                    <div class="text">
                        <p class="name">{{ $data['firstname'] }}</p>
                        <p class="role">{{ $data['role'] }}</p>
                    </div>
                </div>
            </div>
        
            {!! svgIcon('grid', 'grid') !!}
        </div>
    </div>
</section>
