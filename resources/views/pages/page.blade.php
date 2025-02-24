@php
    $blocks = $post->contenu ?: [];
@endphp

@extends('layouts.main', ['post' => $post])

@section('content')
    <x-page-builder :blocks="$blocks" />
@stop
