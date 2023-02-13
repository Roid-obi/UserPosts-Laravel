<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DetailUserController extends Controller
{
    public function show($id) 
    {
        $user = User::findOrFail($id);
        return view('detail.detail',compact('user'));
    }
}
