@extends('layouts.main', compact('post'))

@php
    $menu = getMenu(1);
@endphp

@section('content')
    Accueil
@stop
