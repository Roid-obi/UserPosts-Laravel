<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\comment;
use App\Models\post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class welcome extends Controller
{
    public function index() 
    {
        return view('viewcen.viewcen',[
            'pinnedPosts' => Post::latest()->where('is_pinned',true)->get(),
            "title"=> "Posts",
            'posts' => Post::latest()->paginate(6),
            'tags' => Tag::all()
        ]);
    }


// halaman detail
    public function show($slug)
    {
        $data = $slug;
        // $post = Post::where('slug', $slug)->firstOrFail();
            $shareMedsos = \Share::page(
                "https://github.com/Roid-obi/UserLogin-Laravel",
                $data
            )
            ->facebook()
            ->telegram()
            ->twitter()
            ->whatsapp()
            ->linkedin();
        $post = post::where('slug', $slug)->with('tags', 'categories')->firstOrFail(); //agar urlnya slug
        $post->increment('views');
        $comments = Comment::where('post_id', $post->id)->with('user')->get(); //comment untuk postnya dipost tersebut
        return view('viewcen.detail-viewcen', [
            'post' => $post,
            'comments' => $comments,
            'share' => $shareMedsos,
        ]);
    }


    // comment post
    public function StoreComment(Request $request){
        comment::create([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
            'content' => $request->content
        ]);
        return redirect()->back();
    }

    // update comment
    public function update(Request $request, comment $comment)
    {
        $request->validate([
            'content' => 'required',
        ]);
    
        $comment->content = $request->content;
        $comment->save();
    
        return redirect()->back();
    }
    
   

    // delate comment
    public function destroy($id)
    {
        $comment = comment::findOrFail($id);

        if ($comment->user_id != auth()->id()) {
            abort(403);
        }

        $comment->delete();

        return back();
    }


    // category di klik
    public function showCategory(Category $category) {
        $title = "Categories : $category->nama";
        $tags = Tag::all();
        $posts = $category->categories()->paginate(4);
        $pinnedPosts = $category->categories()->where('is_pinned',true)->get()->all();
        return view('viewcen.viewcen',compact(['posts','pinnedPosts','tags','title']));
    }


    // tag di klik
    public function showTag(Tag $tag) {
        $title = "Tags : $tag->nama";
        $tags = Tag::all();
        $posts = $tag->tags()->paginate(4);
        $pinnedPosts = $tag->tags()->where('is_pinned',true)->get()->all();
        return view('viewcen.viewcen',compact(['posts','pinnedPosts','tags','title']));
    }






}
