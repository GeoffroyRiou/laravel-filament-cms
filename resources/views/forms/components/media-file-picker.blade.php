<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <livewire:media-library-file-picker wire:model="{{ $getStatePath() }}" />
</x-dynamic-component>
