<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;

use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index(){
        $themes = Theme::all();
        return view('forum.theme.home', compact('themes'));
    }
    public function form(){

        return view('forum.theme.form');
    }
    public function formedit($id){
        return view('forum.theme.edit',compact('id'));
    }
    
    public function create(Request $request,$id){
        $request->validate([
            'name'=> 'required|string',
        ]);
       
        
        $themes=new Theme();
        $themes->name=$request->name;
        $themes->author=$id;

        $themes->save();

        return redirect()->route('theme.index');
    }

    public function edit(Request $request,$id){
        $request->validate([
            'name'=>'required|string',
        ]);

        $theme = Theme::where('id',$id)->first();
        $theme->name = $request->name;
        $theme->save();
        return redirect()->route('theme.index');
    }


}
