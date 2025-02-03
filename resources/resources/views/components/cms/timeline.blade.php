@props(['data' => []])

<section class="cms-timeline">

    <div class="inner">

        <div class="cms-timeline__slider">
            <div class="cms-timeline__slider__prev">{!! svgIcon('arrow-down') !!}</div>
            <div class="cms-timeline__slider__next">{!! svgIcon('arrow-down') !!}</div>
            <div class="swiper-wrapper">
                @php($i = 1)
                @foreach ($data['items'] as $item)
                    <div class="swiper-slide timeline-card">

                        <span class="date">{{ formatDateLocalized($item['date'],format : 'j F Y') }}</span>

                        <div class="timeline-card__content">
                            <p class="title">{{ $item['title'] }}</p>
                            <p class="text">{{ $item['text'] }}</p>
                        </div>
                    </div>
                    @php($i++)
                @endforeach
            </div>
        </div>

    </div>

</section>
