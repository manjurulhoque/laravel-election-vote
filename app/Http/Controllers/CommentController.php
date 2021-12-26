<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['create', 'store']);
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required|string',
            'post_id' => 'required',
        ]);

        $new_comment = new Comment();
        $new_comment->description = $request->get('description');
        $new_comment->user_id = auth()->id();
        $new_comment->post_id = $request->get('post_id');
        $new_comment->save();

        return redirect()->back();
    }

    public function show(Comment $comment)
    {
        //
    }

    public function edit(Comment $comment)
    {
        //
    }

    public function update(Request $request, Comment $comment)
    {
        //
    }

    public function destroy(Comment $comment)
    {
        //
    }
}
