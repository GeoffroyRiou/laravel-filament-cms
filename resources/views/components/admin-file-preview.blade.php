@props(['mediaFile'])

<div class="shadow-lg flex flex-col rounded-lg overflow-hidden justify-center items-center h-full w-40 mb-2">
    @if ($mediaFile->isImage())
        <img src="{{ $mediaFile->getFirstMediaUrl('media_files', 'thumbnail') }}" alt="" class="w-20 h-20">
    @else
        <x-admin-file-other />
    @endif
    <small class="mt-auto mb-0 text-center p-1">{{$mediaFile->nom}}</small>
</div>