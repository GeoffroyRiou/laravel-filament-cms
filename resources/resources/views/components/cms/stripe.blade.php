@props(['data' => []])


@php
    $imageUrl = $data['image'] ? imageUrl($data['image'],130,130) : null;
    $boutonPage = $allPages->where('id', $data['bouton_page'])->first();
    $isDark = $data['format'] == 'dark';
@endphp

<section class="cms-stripe {{ $isDark ? '-dark' : '' }}">
    <figure class="cms-stripe__image {{ $isDark ? '-dark' : ''}}">
        <img loading="lazy" src="{{ $imageUrl }}" alt="" class="picture" />
    </figure>
    <div class="cms-stripe__content {{ $isDark ? '-dark' : ''}}">
        <x-front.title-lvl3 :text="$data['title'] ?? ''" :class="$isDark ? '-main-l' : ''" />

        @if (!empty($data['text']))
            <p class="text">
                {{ $data['text'] ?? '' }}
            </p>
        @endif

        @if (!empty($boutonPage))
            <x-front.button :label="$data['bouton_text'] ?? $boutonPage->titre" :link="$boutonPage->getUrl()" :class="'button -fit ' . ($data['bouton_style'] ?? '')" />
        @endif
    </div>
</section>
