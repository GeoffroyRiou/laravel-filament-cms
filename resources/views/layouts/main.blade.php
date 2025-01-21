<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {!! seo($post ?? null) !!}

    @vite(['resources/css/app.scss'])
</head>

<body>
    <x-front.header :currentPost="$post ?? null" />

    @yield('content')

    <x-front.footer />

    <x-gtag />
    <x-matomo />

    @vite(['resources/js/app.js'])
</body>

</html>
