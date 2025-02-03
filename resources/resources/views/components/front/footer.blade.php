@php
    $contactUrl = $allPages->where('id', 9)->first()?->getUrl() ?? '';
    $preinscrireMonEnfantUrl = $allPages->where('id', 8)->first()?->getUrl() ?? '';
    $espaceParentUrl = $allPages->where('id', 6)->first()?->getUrl() ?? '';
    $faqUrl = $allPages->where('id', 7)->first()?->getUrl() ?? '';
@endphp

<footer class="g-footer">
    <div class="inner">
        <div class="g-footer__row">
            <div class="g-footer__contact">
                <x-front.contact-stripe :showAddress="false" class="-white" />
                <x-front.contact-stripe :showPhone="false" class="-white" />
            </div>

            <div class="g-footer__buttons">
                <x-front.button label="Contact" :link="$contactUrl" class="-line-white -big" />
                <x-front.button label="Préinscrire mon enfant" :link="$preinscrireMonEnfantUrl" class="-main-l -big" />
            </div>
        </div>
        <div class="g-footer__row">
            <div class="g-footer__premenu">
                <x-front.button label="Espace parent" :link="$espaceParentUrl" class="-second-d" />
                <x-front.button label="FAQ" :link="$faqUrl" class="-second-d" />
            </div>
        </div>
        <div class="g-footer__row">
            <div class="g-footer__menu">
                <x-front.menu :menuId="2" class="menu"/>
                <a href="https://digital.imageinfrance.com" target="_blank" class="link -iif">Réalisation&nbsp;: {!! svgIcon('logo-iif') !!}</a>
            </div>
        </div>
    </div>
</footer>
