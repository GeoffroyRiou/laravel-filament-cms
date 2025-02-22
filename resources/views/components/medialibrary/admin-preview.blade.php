@props(['mediaFile'])

@if ($mediaFile->isImage())
    <img src="{{ $mediaFile->getUrl() }}" alt="{{ $mediaFile->name }}">
@else
    @svg('heroicon-o-document')
@endif
