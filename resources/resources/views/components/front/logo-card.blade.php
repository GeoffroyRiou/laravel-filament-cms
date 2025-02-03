@props(['logo' => []])

<a href="{{ $logo['link'] ?? '' }}" class="logo-card">
    <figure class="figure">
        <img src="{{ Storage::url($logo['logo']) }}" alt="{{ $logo['label'] }}" class="logo" loading="lazy" />
        <figcaption class="text">{{ $logo['label'] }}</figcaption>
    </figure>
</a>
