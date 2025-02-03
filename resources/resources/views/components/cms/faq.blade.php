@props(['data' => []])

<section class="cms-faq">
    <h2 class="cms-faq__title">
        <span class="text">{{ $data['title'] }}</span>
    </h2>

    <div class="cms-faq__content">
        {!! $data['text'] !!}
    </div>

    <div class="cms-faq__questions">
        @foreach ($data['questions'] as $question)
            <details class="cms-faq__question">
                <summary class="head cms-faq__question__head">
                    {{ $question['title'] }}
                    <span class="icon"></span>
                </summary>
                <div class="body">
                    {!! $question['text'] !!}
                </div>
            </details>
        @endforeach
    </div>
</section>
