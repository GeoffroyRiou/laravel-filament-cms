@extends('layouts.main', [
    'post' => $categorie,
])

@section('content')
    <div class="text-slate-50 bg-slate-600 p-2">
        <x-front-breadcrumb :breadcrumbData="$categorie->getBreadcrumb()" />
    </div>
    <div class="max-w-[1000px] mx-auto border rounded-xl p-5 my-20">
        <h1 class="text-3xl pb-10">{{ $categorie->nom ?? '' }}</h1>

        @if ($auteur = $categorie->field('auteur'))
            <h2>Auteur : {{ $auteur }}</h2>
        @endif

        <h2 class="text-2xl pb-2">Sous catégories</h2>
        @forelse ($categorie->children as $subCategorie)
            <a href="{{ $subCategorie->getUrl() }}" class="block border-b border-slate-600 p-5">
                {{ $subCategorie->nom }}
            </a>
        @empty
            <p>Pas de sous catégories</p>
        @endforelse

        <h2 class="text-2xl pt-10 pb-2">Posts</h2>
        @forelse ($categorie->postsPublished as $post)
            <a href="{{ $post->getUrl() }}" class="block border-b border-slate-600 p-5">
                {{ $post->titre }}
            </a>
        @empty
            <p>Pas de posts</p>
        @endforelse
    </div>
@stop
