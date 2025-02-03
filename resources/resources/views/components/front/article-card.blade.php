@props(['article'])

@php
    $imageUrl = $article->illustration ? imageUrl($article->illustration,290,330) : '';
@endphp
<article class="article-card">
    <div class="content">

        <img loading="lazy" src="{{ $imageUrl }}" alt="" class="picture" />

        @if (!empty($article->categories))
            <div class="article-card__categories">
                @foreach ($article->categories as $category)
                    <span class="category">{{ $category->nom }}</span>
                @endforeach
            </div>
        @endif


        <h3 class="title">{{ $article->titre }}</h3>

        @if (!empty($article->excerpt))
            <p class="text">{{ $article->excerpt }}</p>
        @endif

        <x-front.button label="Lire l'article" :link="$article->getUrl()" class="button -line-main-d" />

    </div>
    {!! svgIcon('grid', 'grid') !!}
</article>
