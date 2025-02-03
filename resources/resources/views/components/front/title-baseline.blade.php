@props(['text' => ''])

<p {{ $attributes->merge(['class' => 'title-baseline']) }}>
    {{ $text }}
</p>
