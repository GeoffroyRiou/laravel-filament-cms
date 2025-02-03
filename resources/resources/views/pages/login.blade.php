@extends('layouts.main')

@section('content')
    <x-front.page-header title="Espace parent" />
    
    <section class="page-login">
        <div class="inner">
            @livewire('login-form')
        </div>

        <img src="{{asset('images/bg-fleurs.avif')}}" alt="" class="bgfirst" />
        <img src="{{asset('images/bg-fleurs.avif')}}" alt="" class="bgsecond" />
    </section>
@stop
