<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\City;
use Illuminate\Http\Request;


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

    public function edit(Request $request, Comment $comment)
    {
        if ($request->user()->cannot('userComment', $comment)) {
            notify()->error('You dont have permission to edit this comment');

            return back();
        }

        return view('edit-comment', ['comment' => $comment]);
    }

    public function update(Comment $comment, CommentRequest $request)
    {
        $comment->content = $request->content;
        $comment->save();

        notify()->success('Comment updated');

        return redirect()->route('dashboard');
    }

    public function destroy(Request $request, Comment $comment)
    {
        if ($request->user()->cannot('userComment', $comment)) {
            notify()->error('You dont have permission to delete this comment');

            return back();
        }

        $comment->delete();

        notify()->success('Comment deleted');

        return redirect()->route('dashboard');
    }
}
