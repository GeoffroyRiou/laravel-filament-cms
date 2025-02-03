@php
    $articles = \App\Models\Post::published()->with('categories')->get();
    $categories = \App\Models\Categorie::with('posts')->whereHas('posts')->get();
@endphp
<section class="cms-articles-list">
    <div class="inner">
        @livewire('articles-list', compact('articles', 'categories'))
    </div>
</section>