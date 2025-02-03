@props(['lightText' => '', 'darkText' => '', 'icon' => ''])

<h2 {{ $attributes->merge(['class' => 'title-lvl2']) }}>

    @if(!empty($icon))
        {!! svgIcon($icon) !!}
    @endif

    <div class="text">
        @if (!empty($lightText))
            <span class="light">{{ $lightText }}</span>
        @endif
        @if (!empty($darkText))
            <span class="dark">{{ $darkText }}</span>
        @endif
    </div>
</h2>
