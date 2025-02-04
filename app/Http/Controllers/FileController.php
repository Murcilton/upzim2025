<?php

namespace App\Http\Controllers;

use App\Models\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files = File::where('user_id', Auth::user()->id)->get();
        return view('files', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file'
        ]);
        $folderName = Auth::user()->name . '-' . Auth::user()->id . '-' . 'folder';
        if (!\Storage::exists('uploads/' . $folderName)) {
            \Storage::makeDirectory('uploads/' . $folderName);
        }
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $path = $request->file('file')->storeAs('uploads/' . $folderName, $fileName, 'public');

        $file = new File;
        $file->name = $fileName;
        $file->path = $path;
        $file->user_id = Auth::user()->id;
        $save = $file->save();

        return redirect()->back()->with('success', 'Файл успешно загружен!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
