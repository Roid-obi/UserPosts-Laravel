<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class alluController extends Controller
{
    public function alluser() {
    $user = User::all();
    return view('alluser',compact('user')); //compact: membuat array dari variabel dan nilainya
}

//menghapus gambar ketika di daftaruser
public function destory($id){
    $item = User::findOrFail($id);
    $path = public_path('storage/images/'.$item->gambar); 
    if(File::exists($path)){
        File::delete($path);
    }
    $item->delete($path);

    return redirect('/home');
}
}
