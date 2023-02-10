<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list()
    {
        return datatables()
            ->eloquent(User::query()->latest())
            ->addColumn('action', function() {
                return '
                    <button class="btn btn-sm btn-danger mr-2">
                        <i class="fa fa-trash"></i>
                    </button>
                ';
            })
            ->addIndexColumn()
            ->escapeColumns(['action'])
            ->toJson();

    }

    public function index()
    {
        return view('user.index');
    }
}





