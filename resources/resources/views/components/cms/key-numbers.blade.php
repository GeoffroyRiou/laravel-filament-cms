@props(['data' => []])

<section class="cms-key-numbers">
    <div class="inner">
        @foreach ($data['numbers'] as $number)
            <div class="item cms-key-numbers__number">
                <img src="{{ Storage::url($number['picto']) }}" alt="" class="logo" loading="lazy"
                    class="icon" />
                <p class="number">{{ $number['number'] }}</p>
                <p class="text">{{ $number['description'] }}</p>
            </div>
        @endforeach
    </div>
</section>
