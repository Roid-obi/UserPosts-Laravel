<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\SavePost;
use App\Models\User;
use Illuminate\Http\Request;


class SavePostController extends Controller
{
    public function show($post)
    {
        $postsaves = SavePost::where('user_id', $post)->get();
        foreach ($postsaves as $ps) {
            $post = post::findOrFail($ps->post_id);
            $ps->post = $post;
        }
        return view('post-save', compact('postsaves'));
    }

    public function store(post $post)
    {
        $user = auth()->user();
        $user->SavePost()->create([
            'post_id' => $post->id,
        ]);
        return redirect()->back();
    }

    public function destroy(Post $post)
    {
        SavePost::where('post_id', $post->id)->delete();
        return redirect()->back();
    }
}
