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

    public function update(Request $request, User $id){
        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'string',
            'tanggal_lahir' => 'date',
            'jenis_kelamin' => 'required',
            'gambar' => 'nullable|image',
            'status' => 'required'
        ]);


        $data =
        [ 
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'role' => $request->role,
            'status' => $request->status,
            
        ];

        // request image
        $imgName ='';
        if($request->file('gambar')){
            $imgName = $request->file('gambar')->getClientOriginalExtension();
            $request->file('gambar')->storeAs('public/images',$imgName);
            $data = array_merge($data, [
                'gambar' => $imgName,
            ]);
        }

        
        $find = User::findOrFail($id->id);
        $find->update($data);

       return redirect('/user');
    }
}
