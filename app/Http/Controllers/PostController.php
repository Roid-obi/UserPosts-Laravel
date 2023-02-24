<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PostController extends Controller
{
    public function index()
    {
        return view('post.index');
    }


    public function list(Request $request)
    {

        
        $category = post::query()
            ->when(!$request->order, function ($query) {
                $query->latest();
            });

        return datatables()
            ->eloquent($category)
            ->addColumn('action', function ($post) {
                return '
                    
                <form onsubmit="destroy(event)" action="'.route('post.destroy', $post->id) .'" method="POST">
                <input type="hidden" name="_token" value="'. @csrf_token() .'">
                <input type="hidden" name="_method" value="DELETE">
                <button class="butn-hapus" >
                <i class="fa fa-trash"></i>
                </button>
            </form>

                        <a href="'. route('post.edit', $post->id).'" class="butn-info" >
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
        return view('post.create',[
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

// input post 
    public function store(Request $request)
    {
        // Validate Request //
        $request->validate(
            [
                'title' => 'required|string',
                'image' => 'required',
                'content' => 'required',
                
            ]
        );

        $data = [
            'created_by' => auth()->user()->nama,
            'title' => $request->title,
            'content' => $request->content,
            'slug' => Str::slug($request->title), //slug berisi title
            'is_pinned' => 0
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $image->storeAs('public/images/', $fileName);
            $data['image'] = $fileName;
        }

        $post = post::create($data);
        $post->tags()->sync($request->input('tags' ,[]));
        $post->categories()->sync($request->input('categories' ,[]));
        return redirect('/post')->with('success', 'post Created Successfully!');
    }


    // edit post
    public function edit($id) 
    {
        return view('post.update', [
            'post' => post::find($id),
            'tags' => Tag::all(),
            'categories' => Category::all(),
        ]);
    }

    // validasi edit
    public function update(Request $request, post $post)
    {
        // Validate Request //
        $find = post::find($post->id);
        $request->validate(
            [
                'title' => 'required|string',
                'image' => 'nullable',
                'content' => 'required|string',
                

            ]
        );

        $data = [
            'title' => $request->title,
            'created_by' => auth()->user()->nama,
            'content' => $request->content,
            'slug' => Str::slug($request->title), //slug berisi title
            'is_pinned' => $request->is_pinned

        ];

        if ($request->hasFile('image')) {
            $post = $request->file('image');
            $imgName = $post->getClientOriginalName();
            $post->storeAs('public/images/', $imgName);
            if($find->image !== null){
                Storage::delete('public/images/'. $find->image);
            }
            $data['image'] = $imgName;
        }

      
        $find->update($data);

        $find->tags()->sync($request->input('tags', []));
        $find->categories()->sync($request->input('categories', []));

        return redirect('/post')->with('success', 'Post Updated Successfully!');
    }

    
    // hapus gam
    public function destroy(post $post)
    {
        $post->delete();
        Storage::delete('public/images/'.$post->image);

        return redirect('/post')->with('success', 'post has been Deleted!');
    }
    
}
