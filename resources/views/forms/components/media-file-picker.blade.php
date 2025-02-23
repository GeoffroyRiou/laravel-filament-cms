<x-dynamic-component :component="$getFieldWrapperView()" :field="$field" x-data="{
    state: $wire.$entangle('{{ $getStatePath() }}')
}"
    x-on:media-file-selected="state = $event.detail">
    @livewire('media-library-file-picker')
</x-dynamic-component>
