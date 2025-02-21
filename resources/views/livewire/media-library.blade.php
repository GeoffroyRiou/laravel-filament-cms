<div>

    @foreach ($headerActions as $action)
        <p>{{ $action }}</p>
    @endforeach

    @foreach ($medias as $media)
        @livewire('media-file-preview', ['mediaFileId' => $media->id])
    @endforeach

    <x-filament-actions::modals />
</div>
