<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function index() {

        $tasks = Task::all();
        
        return view('home', compact('tasks'));
    }


}
