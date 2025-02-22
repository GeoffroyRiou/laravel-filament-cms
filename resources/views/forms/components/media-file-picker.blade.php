<x-dynamic-component :component="$getFieldWrapperView()" :field="$field" x-data="{
    state: $wire.$entangle('{{ $getStatePath() }}')
}">
    <div class="grid xl:grid-cols-4 gap-x-2">
        @foreach ($getMediaFiles() as $mediaFile)
            <label for="media_{{ $mediaFile->id }}" wire:key="media_{{ $mediaFile->id }}" class="opacity-50 relative"
                :class="{ 'opacity-100': state == '{{ $mediaFile->id }}}', 'opacity-50': state != '{{ $mediaFile->id }}' }">
                <input type="radio" id="media_{{ $mediaFile->id }}" :checked="state == {{ $mediaFile->id }}"
                    x-on:change="state = {{ $mediaFile->id }}" class="hidden">
                <x-medialibrary.admin-preview :mediaFile="$mediaFile" />
            </label>
        @endforeach
    </div>
</x-dynamic-component>
