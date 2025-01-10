@props(['titre' => '', 'modificators' => '', 'media' => null])

<section class="page-header {{$modificators}}" @if($media) style="--bg-desktop: url({{ getMediaFileUrl($media, 'page-header-desktop') }}); --bg-mobile: url({{ getMediaFileUrl($media, 'page-header-mobile') }});" @endif)>
    <div class="content">
        <h1 class="titre">{{$titre}}</h1>
        {{$slot}}
    </div>
</section>