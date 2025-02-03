@extends('layouts.main', compact('post'))

@section('content')
    <div class="pb-10">
        <x-front.page-header :title="$post->titre" />
        <x-front.cms :blocks="$post->contenu ?: []" />
    </div>
@stop
