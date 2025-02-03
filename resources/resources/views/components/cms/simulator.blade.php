@props(['data' => []])

<section class="cms-simulator">
    <div class="inner">
        <div class="cms-simulator__table">
            <div class="head">{{ $data['title'] }}</div>
            <div class="body">
                <div class="text">{!! $data['text'] !!}</div>
                <x-front.button :label="$data['button_label'] ?? ''" :link="$data['button_link'] ?? ''" class="button -main-l -fit" />
            </div>
        </div>

        
    </div>
</section>
