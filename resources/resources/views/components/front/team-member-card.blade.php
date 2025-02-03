@props(['data' => []])

@php
    $image = $data['image'] ? imageUrl($data['image'],240,240)  : null;
@endphp
<div {{ $attributes->merge(['class' => 'team-member-card']) }}>

    <div class="inner">
        <div class="team-member-card__head">

            @if (!empty($image))
                <img loading="lazy" src="{{ $image }}" alt="" class="picture" />
            @endif

            <div class="text">
                <p class="name">{{ $data['firstname'] }}</p>
                <p class="job">{{ $data['job'] }}</p>
                <p class="role">{{ $data['role'] }}</p>
            </div>
        </div>
        <div class="team-member-card__text">
            {!! $data['text'] !!}
            <div class="duration">Avec nous depuis {{$data['duration']}}</div>
        </div>
    </div>

    {!! svgIcon('grid', 'grid') !!}
</div>
