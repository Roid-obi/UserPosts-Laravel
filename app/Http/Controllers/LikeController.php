<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // public function show($post)
    // {
    //     $likes = Like::where('user_id', $post)->get();
    //     foreach ($likes as $lk) {
    //         $post = post::findOrFail($lk->post_id);
    //         $lk->post = $post;
    //     }
    //     return view('likes', compact('likes'));
    // }

    public function store(post $post)
    {
        $user = auth()->user();
        $user->Like()->create([
            'post_id' => $post->id,
        ]);
        return redirect()->back();
    }

    public function destroy(Post $post)
    {
        Like::where('post_id', $post->id)->delete();
        return redirect()->back();
    }
}
