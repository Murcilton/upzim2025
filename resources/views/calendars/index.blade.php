@extends('layouts.layout')

@section('content')

<head>
    @vite(['resources/css/calendar.css', 'resources/js/calendar.js'])
</head>

<div class="container">
    <div class="header">
        <div class="menu">
            <input type="checkbox" id="burger-checkbox" class="burger-checkbox">
            <label class="burger" for="burger-checkbox"></label>
        </div>

        <div class="logo-container">
            <img class="LogoCalendar" src="{{ asset('/img/LogoCalendar.png') }}" alt="Логотип Календаря">
            <span class="date-overlay">{{ now()->format('d') }}</span>
        </div>

        <h1>Календарь</h1>
    </div>

    <div class="left-menu">
        <ul>
            <li><a href="#">Главная</a></li>
            <li><a href="#">О нас</a></li>
            <li><a href="#">Услуги</a></li>
            <li><a href="#">Контакты</a></li>
        </ul>
    </div>

    <div class="content">
        <h1>Основной контент</h1>
        <table>
            <tr>
                <th>Пн</th>
                <th>Вт</th>
                <th>Ср</th>
                <th>Чт</th>
                <th>Пт</th>
                <th>Сб</th>
                <th>Вс</th>
            </tr>
            <tr>
                @for ($i = 0; $i < $firstDayOfWeek; $i++)
                    <td></td>
                @endfor
    
                @for ($day = 1; $day <= $daysInMonth; $day++)
                    <td class="calendar-day" data-date="{{ $currentDate->format('Y-m') }}-{{ $day }}">
                        {{ $day }}
                        @foreach ($calendars as $event)
                            @if ($event->start_time->format('Y-m-d') == "{$currentDate->format('Y-m')}-{$day}")
                                <div>{{ $event->title }}</div>
                            @endif
                        @endforeach
                    </td>
                    @if (($day + $firstDayOfWeek) % 7 == 0)
                        </tr><tr>
                    @endif
                @endfor
                
                @for ($i = ($daysInMonth + $firstDayOfWeek) % 7; $i < 7 && $i > 0; $i++)
                    <td></td>
                @endfor
            </tr>
        </table>
    </div>

    <div class="right-menu"></div>
</div>

<!-- Модальное окно для создания события -->
<div id="eventModal" style="display:none;">
    <form id="eventForm" action="{{ route('calendars.store') }}" method="POST">
        @csrf
        <h2>Создать событие</h2>
        
        <label for="title">Название события:</label>
        <input type="text" id="title" name="title" required>
        
        <label for="start_time">Время начала:</label>
        <input type="datetime-local" id="start_time" name="start_time" required>
        
        <label for="end_time">Время окончания:</label>
        <input type="datetime-local" id="end_time" name="end_time" required>
        
        <label for="location">Место:</label>
        <input type="text" id="location" name="location">
        
        <label for="is_all_day">На весь день:</label>
        <input type="checkbox" id="is_all_day" name="is_all_day">
        
        <div style="text-align: center;">
            <button type="submit">Сохранить событие</button>
            <button type="button" onclick="closeModal()">Закрыть</button>
        </div>
    </form>
</div>

@endsection