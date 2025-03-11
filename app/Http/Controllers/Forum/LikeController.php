<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;

use App\Models\Like;
use App\Models\Post; // или Comment
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like($postId)
    {
        $like = Like::where('user_id', Auth::id())->where('post_id', $postId)->first();

        if (!$like) {
            Like::create([
                'user_id' => Auth::id(),
                'post_id' => $postId,
            ]);
        }

        return back();
    }

    public function unlike($postId)
    {
        $like = Like::where('user_id', Auth::id())->where('post_id', $postId)->first();

        if ($like) {
            $like->delete();
        }

        return back();
    }
}

