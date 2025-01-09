@php($contenu = $post->contenu ?: [])

@extends('layouts.main', [
    'post' => $post,
])

@section('content')
    <div class="text-slate-50 bg-slate-600 p-2">
        <x-front-breadcrumb :breadcrumbData="$post->getBreadcrumb()" />
    </div>
    <div class="max-w-[1000px] mx-auto border rounded-xl p-5 my-20">
        <h1 class="text-3xl">{{ $post->titre ?? '' }}</h1>
        <x-front-cms :contenu="$contenu" />
    </div>
@stop
