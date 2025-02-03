@props(['menuId'])

@php
    $menuItems = getMenu($menuId);
@endphp

<ul {{$attributes->merge(['class' => ''])}}>
    @foreach ($menuItems as $index => $item)
        @php
            $isLink = !(empty($item['lien']) || $item['lien'] == '#');
        @endphp
        <li class="item" x-data="{ showSubmenu: false }" x-on:click.outside="showSubmenu = false">

            @if (!$isLink)
                <span class="link" x-on:click="showSubmenu = !showSubmenu"  :class="{ '-active': showSubmenu }">
            @else
                <a href="{{ $item['lien'] }}" class="link">
            @endif

            <span class="text">{{ $item['texte'] }}</span>

            @if (count($item['children']) > 0)
                {!! svgIcon('arrow-down', 'arrow') !!}
            @endif

            @if (!$isLink)
                </span>
            @else
                </a>
            @endif

            @if (!empty($item['children']))
                <ul class="submenu" :class="{ '-active': showSubmenu }">
                    @foreach ($item['children'] as $child)
                        <li class="submenu__item">
                            <a href="{{ $child['lien'] }}" class="link">
                                <span class="text">{{ $child['texte'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>
