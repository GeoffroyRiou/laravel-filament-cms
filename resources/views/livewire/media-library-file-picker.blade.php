<div>
    @foreach ($mediaFiles as $mediaFile)
        <div wire:click="selectMediaFile({{ $mediaFile->id }})">
            <x-medialibrary.admin-preview :mediaFile="$mediaFile" />
        </div>
    @endforeach

    {{ $mediaFiles->links() }}
</div>
