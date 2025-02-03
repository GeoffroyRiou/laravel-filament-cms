@props(['data' => []])

@php

    $url = '';
    $label = $data['label'] ?? ($data['bouton_text'] ?? 'Découvrir');

    switch ($data['type']) {
        case 'page':
            $url = $allPages->where('id', $data['bouton_page'])->first()->getUrl();
            break;
        case 'customLink':
            $url = $data['link'];
            break;
        case 'file':
            $url = Storage::url($data['file']);
            break;
        case 'filePrivate':
            $url = route('espace_parents.document.download', ['file' => $data['filePrivate']]);
            break;
    }
@endphp

<section class="g-container-small pb-5">
    <a href="{{ $url }}"
        class="cms-simple-button {{ $data['style'] ?? '' }} {{ empty($data['subtitle']) ? '-no-subtitle' : '' }}">
        @if (!empty($data['icon']))
            <span class="picto">
                {!! svgIcon($data['icon']) !!}
            </span>
        @endif
        <div class="content">
            <span class="title">{{ $label }}</span>
            @if (!empty($data['subtitle']))
                <span class="subtitle">{{ $data['subtitle'] }}</span>
            @endif
        </div>

        <div class="end cms-simple-button__end">
            <span class="text">Visionner</span>
            <span class="arrow">
                {!! svgIcon('arrow-down') !!}
            </span>
        </div>
    </a>
</section>
