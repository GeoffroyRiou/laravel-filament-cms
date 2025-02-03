@props(['data' => []])

@php
    $bgColorClass = $data['bgColor'] ? '-' . $data['bgColor'] : '';
@endphp

<section class="cms-team {{ $bgColorClass }}">
    <div class="inner">
        @foreach ($data['members'] as $member)
            <x-front.team-member-card :data="$member" class="card"/>
        @endforeach
    </div>
</section>
