<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <livewire:CMS.media-library-file-picker wire:model="{{ $getStatePath() }}" />
</x-dynamic-component>
