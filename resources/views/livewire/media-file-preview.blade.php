<div class="media-library__preview">
    {{ $this->editAction() }}
    <img src="{{ imageUrl($mediaFile->path, 100, 100) }}" alt="">
    <x-filament-actions::modals />
</div>
