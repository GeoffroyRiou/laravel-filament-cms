@props([
    'preinscrireMonEnfantUrl',
    'espaceParentUrl',
    'faqUrl',
])
<nav class="header-menu" :class="{'-active': showMenu}">
    <div class="header-menu__topbar">
        <div class="text">menu</div>
        <button type="button" aria-label="Fermer le menu" class="close" x-on:click="showMenu = false">
            {!! svgIcon('close') !!}
        </button>
    </div>
    <div class="header-menu__body">
        <x-front.menu :menuId="1" class="header-menu__body__menu"  />

        <div class="header-menu__body__footer">

            <div class="section">
                <x-front.contact-stripe :showPhone="false" />
            </div>

            <div class="section">
                <x-front.button label="{{$settings->telephone}}" link="tel:{{$settings->telephone}}" icon="phone" class="-line-main-d -big"/>
            </div>

            <div class="section">
                {{$buttons}}
            </div>
    
        </div>

    </div>
</nav>