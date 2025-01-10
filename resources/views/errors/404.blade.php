@extends('layouts.main')

@section('content')
    <div>
        <p>404</p>
        <p>Cette page n'existe pas ou a été déplacée.</p>
        <a href="{{route('home')}}">Acceuil</a>
    </div>
@stop
