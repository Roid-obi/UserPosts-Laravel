<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoController extends Controller
{
    public function index()
    {
        return view('category.index');
    }


    public function list()
    {
        return datatables()
            ->eloquent(Category::query()->latest())
            ->addColumn('action', function ($categoty) {
                return '
                    
                        <form onsubmit="destroy(\'event\')" action="' . route('catego.destroy', $categoty->id) . '" method="POST">
                        <input type="hidden" name="_token" value="'. @csrf_token() .'" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="DELETE">
                        <button onclick="return confirm(`apakah anda yakin ingin menghapus tag ini?`)" class="butn-hapus" >
                                <i class="fa fa-trash"></i>
                            </button>
                            </td>
                        </form>

                        <a href="'. route('tag.edit', $categoty->id).'" class="butn-info" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
    </svg>
                        </a>
                    
                ';
            })
            ->addIndexColumn()
            ->escapeColumns(['action'])
            ->toJson();
    }

//halaman create
    public function create()
    {
        return view('category.create');
    }

// input tag 
    public function store(Request $request)
    {
        // Validate Request //
        $request->validate(
            [
                'nama' => 'required|string',
            ]
        );

        $data = [
            'created_by' => auth()->user()->nama,
            'nama' => $request->nama
        ];
        Category::create($data);
        return redirect('/category')->with('success', 'Categoty Created Successfully!');
    }


    // edit tag
    public function edit($id) 
    {
        $categoty = Category::find($id);
        return view('category.update', compact('category'));
    }

    
    public function update(Request $request, Category $category)
    {
        // Validate Request //
        $request->validate(
            [
                'nama' => 'required|string',
            ]
        );

        $data = [
            'nama' => $request->nama,
        ];

        $findCategory = Category::find($category->id);
        $findCategory ->update($data);

        return redirect('/category')->with('success', 'Tag Updated Successfully!');
    }

    
    // hapus tag
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()->with('success', 'User has been Deleted!');;
    }
}
