@php
    $contenu = $post->contenu ?: [];
    $illustration = $post->illustration ?? null;
@endphp

@extends('layouts.main', ['post' => $post, 'hideOnDiscute' => true])

@section('content')
    <x-front-cms :contenu="$contenu" />
@stop
