@props(['breadcrumbData'])

@if(!empty($breadcrumbData))
    <nav>
        <ul class="flex gap-2">
            <li>
                <a href="{{route('home')}}">Accueil</a>
            </li>
            @foreach ($breadcrumbData as $item)
                <li>&gt;</li>
                <li>
                    <a href="{{ $item['lien'] }}">{{ $item['texte'] }}</a>
                </li>
            @endforeach
        </ul>
    </nav>
@endif
