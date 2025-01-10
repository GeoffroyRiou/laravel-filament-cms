@php
    $logos = $post->field('logos') ?? [];
    $actualites = $post->field('actualites') ?? [];
@endphp

@extends('layouts.main', compact('post'))

@section('content')
    Accueil
@stop
