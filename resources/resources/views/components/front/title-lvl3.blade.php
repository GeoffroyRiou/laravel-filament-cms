@props(['text' => ''])

<h3 {{ $attributes->merge(['class' => 'title-lvl3']) }}>
    {{ $text }}
</h3>
