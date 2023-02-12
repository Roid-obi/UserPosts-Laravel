<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UpdateUserController extends Controller
{
    public function edit($id)
    {
        $kelamin = Auth::user()->jenis_kelamin;
        Session::flash('jenis_kelamin', $kelamin);
        return view('edit');
    }
    
    public function update(Request $req)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $req->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'gambar' => 'nullable|image'
        ]);
        $data = 
        [
            'nama' => $req->nama,
            'alamat' => $req->alamat,
            'tanggal_lahir' => $req->tanggal_lahir,
            'jenis kelamin' => $req->jenis_kelamin,
        ];
        if ($req->hasFile('gambar')) {
            $gambar = $req->file('gambar');
            $fileName = $gambar->getClientOriginalName();
            $gambar->storeAs('public/images/', $fileName);

        if ($user->gambar !== null) {
            Storage::delete('public/images/' . $user->gambar);
        }
            $data['gambar'] = $fileName;
        }
        $user->update($data);
        return redirect('/home');
    }
}
