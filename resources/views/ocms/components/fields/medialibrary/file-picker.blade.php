<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <livewire:ocms-media-file-picker wire:model="{{ $getStatePath() }}" />
</x-dynamic-component>
