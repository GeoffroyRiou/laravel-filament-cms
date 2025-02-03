@props(['data' => []])

<div class="cms-benefits">
    <div class="inner">

        <div class="cms-benefits__benefits">
            @php($i = 1)
            @foreach ($data['benefits'] as $benefit)
                <div class="benefit">
                    <h2 class="title">{{ $benefit['title'] }}</h2>
                    <div class="text">
                        {!! $benefit['text'] !!}
                    </div>
                    @php($i++)
                </div>
            @endforeach
        </div>
    </div>
</div>
