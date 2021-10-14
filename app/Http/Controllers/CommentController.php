<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\City;

class CommentController extends Controller
{
    public function create()
    {
        $cities = City::get();

        return view('comment-create', ['cities' => $cities]);
    }

    public function store(CommentRequest $request)
    {
        Comment::create($request->all());

        notify()->success('Comment posted');

        return redirect()->route('dashboard');
    }

    public function edit(Comment $comment)
    {
        return view('edit-comment', ['comment' => $comment]);
    }

    public function update(Comment $comment, CommentRequest $request)
    {
        $comment->content = $request->content;
        $comment->save();

        notify()->success('Comment updated');

        return redirect()->route('dashboard');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        notify()->success('Comment deleted');

        return redirect()->route('dashboard');
    }
}
