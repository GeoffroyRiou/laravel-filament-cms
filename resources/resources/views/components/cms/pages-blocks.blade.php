@props(['data' => []])

@php
    $cards = $data['cards'] ?? [];
@endphp
<section class="cms-pages-blocks">
    @foreach ($cards as $card)
        <x-front.page-card :data="$card" :isAlone="count($cards) === 1"/>
    @endforeach
</section>
