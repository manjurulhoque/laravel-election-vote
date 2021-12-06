<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only('create', 'store', 'update', 'edit');
    }

    public function index()
    {
        $posts = Post::select("*")->with('user', 'comments')->orderBy("created_at", "desc")->get();

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required|string'
        ]);

        $new_post = new Post();
        $new_post->description = $request->get('description');
        $new_post->user_id = auth()->id();
        $new_post->save();

        return redirect(route('posts.index'));
    }


    public function show(Post $post)
    {
        $post->with('user', 'comments');

        return view('posts.show', compact('post'));
    }


    public function edit(Post $post)
    {
        //
    }


    public function update(Request $request, Post $post)
    {
        //
    }


    public function destroy(Post $post)
    {
        //
    }
}
