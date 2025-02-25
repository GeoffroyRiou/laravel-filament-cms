@props(['data' => []])
@php(extract($data))

<a href="{{ $link ?? '' }}" class="cms-button">{{ $label ?? 'Découvrir' }}</a>
