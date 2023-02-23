<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;

class welcome extends Controller
{
    public function __invoke() 
    {
        return view('viewcen',[
            "title"=> "Posts",
            "posts" => post::latest()->get() //yang terakhir akan berada di atas
        ]);
    }
}
