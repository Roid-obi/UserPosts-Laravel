<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    //Jika kita perlu mendefinisikan sebuah controller hanya dengan 1 action, kita bisa menggunakan method __invoke pada controller.
    public function __invoke() 
    {
        return view('home');
    }

    
}
