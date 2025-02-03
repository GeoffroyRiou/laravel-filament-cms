@props(['currentPost'])
@php
    $isFrontPage = isFrontpage($currentPost);
    $espaceParentUrl = $allPages->where('id',6)->first()?->getUrl() ?? '';
    $faqUrl = $allPages->where('id',7)->first()?->getUrl() ?? '';
    $preinscrireMonEnfantUrl = $allPages->where('id',8)->first()?->getUrl() ?? '';
@endphp

<header class="g-header" :class="{ '-sticky': !atTop }" x-data="{ atTop: true, showMenu: false }"
    @scroll.window="atTop = (window.pageYOffset < 64) ? true : false;">

    <div class="g-header__row -firstrow" :class="{ '-sticky': !atTop }">
        <div class="inner">
            <x-front.contact-stripe class="-main-l"/>

            <div class="g-header__actions -desktop">
                <x-front.button label="Préinscrire mon enfant" :link="$preinscrireMonEnfantUrl" class="-main-l -fit"/>
                <x-front.button label="Espace Parent" :link="$espaceParentUrl" class="-line-white -fit"/>
                <x-front.button label="F.A.Q" :link="$faqUrl"  class="-line-white -fit"/>
            </div>
        </div>
    </div>

    <div class="g-header__row -secondrow">
        <div class="inner">
            <a href="{{ route('home') }}" class="g-header__logo" :class="{ '-sticky': !atTop }" aria-label="Accueil">
                <span class="big">{!! svgContent('logo') !!}</span>
                <span class="small">{!! svgContent('logo-horizontal') !!}</span>
            </a>

            <div>
                <x-front.header-menu >
                    <x-slot:buttons>
                        <x-front.button label="Préinscrire mon enfant" :link="$preinscrireMonEnfantUrl" class="-main-l -big"/>
                        <x-front.button label="Espace Parent" :link="$espaceParentUrl" class="-second-m -big"/>
                        <x-front.button label="F.A.Q" :link="$faqUrl"  class="-second-m -big"/>
                    </x-slot>
                </x-front.header-menu>
            </div>

            <div class="g-header__actions -mobile">
                <a href="tel:{{ $settings->telephone }}" class="g-header__actions__action -medium">
                    {!! svgIcon('phone') !!}
                </a>
                <button type="button" aria-label="Ouvrir le menu" class="g-header__actions__action -light"
                    x-on:click="showMenu = true">
                    <span class="text">Menu</span>
                    {!! svgIcon('burger', 'icon -burger') !!}
                </button>
            </div>
        </div>
    </div>
</header>
