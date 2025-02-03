@props(['data' => [],'cms.hero' => []])

@php
    $bouton1Page= $allPages->where('id', $data['bouton1_page'])->first();
    $bouton2Page = $allPages->where('id', $data['bouton2_page'])->first();
@endphp
<section class="cms-hero">
    <div class="cms-hero__inner">
        <div class="col">
            {!! svgContent('illu-hero') !!}
        </div>
        <div class="col cms-hero__right-col">
            <div class="content">
                <x-front.title-lvl2 darkText="{{$data['titre']}}" />

                <div class="middle">
                    <x-front.title-baseline text="{{$data['baseline']}}" />
                    <x-front.schedules text="{{$data['horaires']}}" />
                </div>

                <p class="text">
                    {{$data['intro']}}
                </p>

                <div class="footer">
                    <x-front.button :label="$data['bouton1_text'] ?? $bouton1Page->titre" :link="$bouton1Page->getUrl()" :class="$data['bouton1_style']" />
                    <x-front.button :label="$data['bouton2_text'] ?? $bouton2Page->titre" :link="$bouton2Page->getUrl()" :class="$data['bouton2_style']" />
                </div>
            </div>
        </div>

        <a href="#content" type="button" class="cms-hero__scrollto">
            {!! svgIcon('arrow-down') !!}
        </a>

        <div class="cloud -left">
            {!! svgContent('cloud') !!}
        </div>

        <div class="cloud -right">
            {!! svgContent('cloud') !!}
        </div>
    </div>
</section>

<a id="content"></a>
