<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {

        $tasks = Task::all();
        
        return view('home', compact('tasks'));
    }

    public function edit(Request $request, $id) {
        $findTask = Task::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:9999',
            'status' => 'required|string|max:255',
            'deadline' => 'required|date',
        ]);
        $findTask->update($request->all());

        return redirect()->back()->with('success', 'Задача успешно обновлена!');
    }

    public function create(Request $request) {
        $val = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:9999',
            'status' => 'required|string|max:255',
            'deadline' => 'required|date',
        ]);
        Task::create($val);

        return redirect()->back()->with('success', 'Задача успешно создана!');
    }

    public function destroy($id) {
        $task = Task::findOrFail($id);
        $task->delete();
    
        return redirect()->back()->with('success', 'Задача успешно удалена!');
    }

}
