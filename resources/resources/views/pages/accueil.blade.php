@extends('layouts.main', compact('post'))

@section('content')
    <x-front.cms :blocks="$post->contenu ?: []" />
@stop
