@extends('layouts.layout')

@section('content')
    <h1>Календарь</h1>
    <a href="{{ route('calendars.create') }}">Создать событие</a>
    <ul>
        @foreach ($calendars as $calendar)
            <li>
                {{ $calendar->title }} ({{ $calendar->start_time }} - {{ $calendar->end_time }})
                @if ($calendar->location)
                    <br>Место: {{ $calendar->location }}
                @endif
                <br>Событие на весь день: {{ $calendar->is_all_day ? 'Да' : 'Нет' }}
                <form action="{{ route('calendars.destroy', $calendar) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Удалить</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
