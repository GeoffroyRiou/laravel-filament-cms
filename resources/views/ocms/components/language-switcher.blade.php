@php($languagesAvailable = config('languages'))

@if(count($languagesAvailable) > 1)
    <form action="{{ route('language.switch') }}" method="post">
        @csrf
        <select name="language" onchange="this.form.submit()">
            @foreach ($languagesAvailable as $language)
                <option value="{{$language}}" {{app()->getLocale() === $language ? 'selected' : ''}}>{{ strtoupper($language) }}</option>
            @endforeach
        </select>
    </form>
@endif
