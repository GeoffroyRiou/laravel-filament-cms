@props(['breadcrumbData'])

@if(!empty($breadcrumbData))
    <nav>
        <ul>
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
