<x-dynamic-component :component="$getFieldWrapperView()" :field="$field" x-data="{
    state: $wire.$entangle('{{ $getStatePath() }}'),
}"
x-on:media-file-selected="state = $event.detail[0] || '';">
    <div class="media-library__field">
        <div x-show="state">
            @php($mediaFile = $getMediaFile())
            @if ($mediaFile)
                <div style="width: fit-content">
                    <x-medialibrary.admin-preview :mediaFile="$mediaFile" class="-alone"/>
                </div>
            @endif
        </div>
        <div class="actions">
            {{ $getAction('picker') }} ou {{ $getAction('upload') }}
        </div>
    </div>
</x-dynamic-component>
