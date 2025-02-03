@props(['data' => []])

@php
    $boutonPage = $allPages->where('id', $data['bouton_page'])->first();
    $articles = App\Models\Post::published()->with('categories')->orderBy('created_at', 'desc')->take(2)->get();
@endphp

<section class="cms-last-articles">
    <div class="cms-last-articles__content">
        <div class="head">
            <x-front.title-lvl2 :lightText="$data['title_light'] ?? ''" :darkText="$data['title_dark'] ?? ''" class="title"/>
        </div>
        <div class="text">
            {!! $data['text'] ?? '' !!}
        </div>
        @if (!empty($boutonPage))
            <x-front.button :label="$data['bouton_text'] ?? $boutonPage->titre" :link="$boutonPage->getUrl()" :class="'desktopbutton -fit ' . ($data['bouton_style'] ?? '')" />
        @endif
    </div>
    <div class="cms-last-articles__articles">
        @foreach ($articles as $article)
            <x-front.article-card :article="$article" />
        @endforeach
    </div>
    @if (!empty($boutonPage))
        <x-front.button :label="$data['bouton_text'] ?? $boutonPage->titre" :link="$boutonPage->getUrl()" :class="'mobilebutton -fit ' . ($data['bouton_style'] ?? '')" />
    @endif
</section>
