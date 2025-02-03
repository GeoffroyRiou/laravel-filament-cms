
@props(['label', 'link', 'icon' => null])

<a href="{{ $link }}" {{ $attributes->merge(['class' => 'g-button']) }}>
    @if($icon)
        {!!  svgIcon($icon) !!} |
    @endif
    {{ $label }}
</a>
