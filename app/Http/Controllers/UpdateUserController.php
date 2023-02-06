<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UpdateUserController extends Controller
{
    public function edit($id)
    {
        $gender = Auth::user()->gender;
        Session::flash('jenis_kelamin', $gender);
        return view('edit');
    }
    
    public function update(Request $req)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $req->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string|',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
        ]);
        $data = 
        [
            'nama' => $req->nama,
            'alamat' => $req->alamat,
            'tanggal_lahir' => $req->tanggal_lahir,
            'jenis_kelamin' => $req->jenis_kelamin,
        ];
        $user->update($data);
        return redirect('/home');
    }
}
