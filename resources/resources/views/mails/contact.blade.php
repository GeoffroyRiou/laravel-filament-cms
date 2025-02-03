@foreach ($data['champs'] as $label => $value)
    <p>
        <strong>{{$label}} : </strong>
        @if (is_array($value))
            {{ implode(', ', $value) }}
        @else
            {{ $value }}
        @endif
    </p>
@endforeach
