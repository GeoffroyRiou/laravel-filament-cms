<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    {!! seo($post ?? null) !!}

    @vite(['resources/css/app.scss'])
</head>

<body>
    <x-language-switcher />

    <ul class="flex gap-2 bg-slate-300 p-5 justify-center">
        <li>
            <a class="p-2 rounded-lg bg-slate-600 text-slate-50" href="{{ route('home') }}">
                Accueil
            </a>
        </li>
        @foreach (getMenu(1) as $lien)
            <li>
                <a class="p-2 rounded-lg bg-slate-600 text-slate-50" href="{{ $lien['lien'] }}" {{ !empty($lien['blank']) ? 'target="_blank"' : '' }}>
                    {{ $lien['texte'] }}
                </a>
            </li>
        @endforeach
    </ul>


    @yield('content')

    <x-gtag />
    <x-matomo />

    @vite(['resources/js/app.js'])
</body>

</html>
