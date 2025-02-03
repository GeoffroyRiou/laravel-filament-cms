@props(['data' => []])

@php
    $illustration = $data['image'] ? asset(imageUrl($data['image'], 735, 590)) : null;
    $bgColorClass = $data['bgColor'] ? '-' . $data['bgColor'] : '';
@endphp

<section class="cms-arrangement {{ $bgColorClass }}">
    <div class="inner">

        <div class="cms-arrangement__head">
            <x-front.title-lvl2 :darkText="$data['title']" class="-always-centered -over{{ $bgColorClass }}" />
            <h3 class="subtitle">{{ $data['subtitle'] }}</h3>
        </div>

        <div class="cms-arrangement__body">
            @if (!empty($illustration))
                <div class="illustration" style="--bg: url({{ $illustration }})"></div>
            @endif

            <div class="cms-arrangement__steps" x-data="{ openTab: 'tab-0' }">
                <div class="content">
                    @foreach ($data['items'] as $index => $step)
                        @php
                            $illustrationStepBig = $step['image'] ? imageUrl($step['image'], 500, 320) : null;
                            $illustrationStepSmall = $step['image'] ? imageUrl($step['image'], 330, 230) : null;
                        @endphp

                        <div class="cms-arrangement__steps__step"
                            :class="{ '-open': openTab === 'tab-{{ $index }}' }">

                            <button class="toggle" type="button" aria-label="Afficher {{ $step['title'] }}"
                                x-on:click="openTab = 'tab-{{ $index }}'">{{ $step['label'] }}</button>

                            <div class="content cms-arrangement__steps__step-content">
                                <h4 class="title">{{ $step['title'] }}</h4>
                                <div class="body">
                                    @if (!empty($step['image']))
                                        <picture>
                                            <source srcset="{{ $illustrationStepSmall }}" media="(max-width: 768px)">
                                            <source srcset="{{ $illustrationStepBig }}" media="(min-width: 768px)">
                                            <img loading="lazy" src="{{ $illustrationStepSmall }}" alt="" />
                                        </picture>
                                    @endif
                                    <div class="text">
                                        {{ $step['text'] }}
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
                <div class="menu">
                    @foreach ($data['items'] as $index => $step)
                        <button class="cms-arrangement__menu-item"
                            :class="{ '-active': openTab === 'tab-{{ $index }}' }" type="button"
                            aria-label="Afficher {{ $step['title'] }}"
                            x-on:click="openTab = 'tab-{{ $index }}'">{{ $step['label'] }}</button>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    {!! svgIcon('grid', 'grid') !!}
</section>
