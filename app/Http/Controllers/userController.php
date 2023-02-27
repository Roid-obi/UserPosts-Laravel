<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // public function list()
    // {
    //     return datatables()
    //         ->eloquent(User::query()->latest())
    //         ->addColumn('action', function() {
    //             return '
    //                 <button class="btn btn-sm btn-danger mr-2">
    //                     <i class="fa fa-trash"></i>
    //                 </button>
    //             ';
    //         })
    //         ->addIndexColumn()
    //         ->escapeColumns(['action'])
    //         ->toJson();

    // }

    // public function index()
    // {
    //     return view('user.index');
    // }
    public function list()
    {
        return datatables()
            ->eloquent(User::query()->where('role','!=','superadmin')->latest())
            // ->addColumn('action', function ($user) {
            //     return '
            //     <form action="'.route('destroy', $user->id) .'" method="POST">
            //         <input type="hidden" name="_token" value="'. @csrf_token() .'">
            //         <input type="hidden" name="_method" value="DELETE">
            //         <button class="btn btn-sm btn-danger mr-2 mt-2">
            //         <i class="fa fa-trash"></i>
            //         </button>
            //     </form>
            //     ';
            // })

            ->addColumn('action', function ($user) {
                    return '
                    <form onsubmit="destroy(event)" action="'.route('destroy', $user->id) .'" method="POST">
                        <input type="hidden" name="_token" value="'. @csrf_token() .'">
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="butn-hapus" >
                        <i class="fa fa-trash"></i>
                        </button>
                    </form>

                    <a href="'. route('show', $user->id).'" class="butn-info" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg>
                    </a>
                    ';
                })

                // ->addColumn('status', function(){
                //     return true == 'Active'
                //     ? '<p class="text-success fw-bold">active</p>' : '<p class="text-danger fw-bold">inactive</p>';
                // })

                ->addColumn('status', function($user){
                    return $user->status == 'active'
                    ? '<p class="badge badge-success fw-bold">active</p>' : '<p class="badge badge-danger fw-bold">Blocked</p>';
                })


            ->addColumn ('gambar', function($user){
                if($user->gambar){
                    return'<img  src= "'.asset('/storage/public/images/'. $user->gambar ).'"  class="img-circle" style="width: 50px" >';
                }else{
                    return'<img id="images-default" src="'. asset('gambar/npc.jpg').'" class="img-circle" style="width: 50px">';
                }
            })


            ->addIndexColumn()
            ->escapeColumns(['action'])
            ->toJson();
    }

    public function index()
    {
        return view('user.index');
    }

public function destroy(User $user)
{
   $user->delete();

   return redirect()->back();
}

// public function edit($id)
// {
//     $user = User::find($id);
//     return view('detail.detail', compact('user'));
// }



//update user


// hal user
public function create()
    {
        return view('user.create-admin');
    }


// input user
public function store(Request $request)
{
    // Validate Request //
    $request->validate(
        [
            'nama' => ['required', 'string', 'max:255','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required','string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]
    );

    $data = [
        
        'nama' => $request->nama,
        'email' => $request->email,
        'password' => Hash::make($request['password']),
        'role' => $request->role

    ];
    User::create($data);
    return redirect('/user')->with('success', 'user Created Successfully!');
}

}





