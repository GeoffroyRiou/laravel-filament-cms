@php
    $contenu = $post->contenu ?: [];
    $illustration = $post->illustration ?? null;
@endphp

@extends('layouts.main', ['post' => $post])

@section('content')
    <h1>{{$post->titre}}</h1>
    <x-front-cms :contenu="$contenu" />
@stop
