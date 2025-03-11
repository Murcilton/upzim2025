<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;

use App\Models\Comment;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index($id){
        $forum = Theme::findOrFail($id);
        $comments = Comment::where('theme_id',$id)->orderBy('created_at', 'desc')->paginate(7);    

        $users = User::select('id','name')->get(); 
        return view('forum.forum.home',compact('forum','comments','users'));
    }

    public function create(Request $request, $id){
        $request->validate([
            'text'=> 'required|string',
        ]);
        $forum = new Comment();
        $forum->author = $id;
        $forum->theme_id = $request->id;
        $forum->text = $request->text;
        $forum->save();

       
        return redirect()->route('forum.home', [ 'id' => $request->id]);

    }

    public function status($id){

        $theme = Theme::findOrFail($id);
       if($theme->status ==1) {
        $theme->status=0;
       }else{
        $theme->status=1;
       }

       $theme->save();


        return redirect()->route('forum.home', [ 'id' => $id]);
    }

    public function edit(Request $request,$id){
        $request->validate([
            'text'=> 'required|string',
        ]);

        $comment = Comment::where('id',$id)->first();
        $comment->text = $request->text;

        $comment->save();

        return redirect()->route('forum.home', [ 'id' => $request->id]);
    }
}
