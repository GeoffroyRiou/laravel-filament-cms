@props(['showAddress' => true, 'showPhone' => true])

<address {{ $attributes->merge(['class' => 'contact-stripe']) }}>

    @if ($showAddress)
        <span class="item">
            {!! svgIcon('pinmap') !!} <span class="text">{{ $settings->adresse }}</span>
        </span>
    @endif

    @if ($showPhone)
        <a href="tel:{{ $settings->telephone }}" class="item">
            {!! svgIcon('phone') !!} <span class="text">{{ $settings->telephone }}</span>
        </a>
    @endif
</address>
