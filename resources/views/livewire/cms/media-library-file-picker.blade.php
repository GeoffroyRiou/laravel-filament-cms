<div class="media-library__list">

    <div class="media-library__list">
        <div class="list">
            @foreach ($mediaFiles as $mediaFile)
                <x-ocms::fields.medialibrary.preview :mediaFile="$mediaFile" wire:click="selectMediaFile({{ $mediaFile->id }})"
                    class="media-library__card {{ $mediaFileId == $mediaFile->id ? '-active' : '' }}" />
            @endforeach
        </div>

        <div class="pagination">
            {{ $mediaFiles->links() }}
        </div>
    </div>
</div>
