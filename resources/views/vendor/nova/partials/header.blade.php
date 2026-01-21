@php
    $languages = ['az','en','ru']; // Burada istəsən DB-dən də çəkə bilərsən
@endphp

<form method="POST" action="{{ route('nova.set-locale') }}" style="display:inline">
    @csrf
    <select name="locale" onchange="this.form.submit()">
        @foreach($languages as $lang)
            <option value="{{ $lang }}" @if(app()->getLocale() == $lang) selected @endif>
                {{ strtoupper($lang) }}
            </option>
        @endforeach
    </select>
</form>
