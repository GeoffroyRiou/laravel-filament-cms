@extends('layouts.main', compact('post'))

@section('content')
    {{$post->field('heroTitre')}}
@stop
