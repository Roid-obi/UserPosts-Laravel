<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;

class welcome extends Controller
{
    public function index() 
    {
        return view('viewcen.viewcen',[
            "title"=> "Posts",
            "posts" => post::latest()->get() //yang terakhir akan berada di atas
        ]);
    }


    public function show($slug)
    {
        $post = post::where('slug', $slug)->firstOrFail();
        return view('viewcen.detail-viewcen',compact('post'));

    }
}
