<x-dynamic-component :component="$getFieldWrapperView()" :field="$field" x-data="{
    state: $wire.$entangle('{{ $getStatePath() }}'),
}">
    <div>
        <div x-show="state">
            @php($mediaFile = $getMediaFile())
            @if ($mediaFile)
                <div style="width: fit-content">
                    <x-admin-file-preview :mediaFile="$mediaFile" />
                </div>
            @endif
        </div>
        <div class="p-2">
            {{ $getAction('picker') }} ou {{ $getAction('upload') }}
        </div>

    </div>
</x-dynamic-component>
