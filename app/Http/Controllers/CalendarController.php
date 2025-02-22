<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $calendars = Calendar::all();
        return view('calendars.index', compact('calendars'));
    }

    public function create()
    {
        return view('calendars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'location' => 'nullable|string|max:255', // Валидация для поля местоположения
            'is_all_day' => 'boolean', // Валидация для флага события на весь день
        ]);

        Calendar::create($request->all());
        return redirect()->route('calendars.index')->with('success', 'Событие успешно создано!');
    }

    public function destroy(Calendar $calendar)
    {
        $calendar->delete();
        return redirect()->route('calendars.index')->with('success', 'Событие успешно удалено!');
    }
}
