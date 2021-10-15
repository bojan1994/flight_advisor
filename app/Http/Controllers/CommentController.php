<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\City;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Return create view
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $cities = City::get();

        return view('comment-create', ['cities' => $cities]);
    }

    /**
     * Store comment
     *
     * @param CommentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CommentRequest $request)
    {
        Comment::create($request->all());

        notify()->success('Comment posted');

        return redirect()->route('dashboard');
    }

    /**
     * Return edit view
     *
     * @param Request $request
     * @param Comment $comment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, Comment $comment)
    {
        if ($request->user()->cannot('userComment', $comment)) {
            notify()->error('You dont have permission to edit this comment');

            return back();
        }

        return view('edit-comment', ['comment' => $comment]);
    }

    /**
     * Update comment
     *
     * @param Comment $comment
     * @param CommentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Comment $comment, CommentRequest $request)
    {
        $comment->content = $request->content;
        $comment->save();

        notify()->success('Comment updated');

        return redirect()->route('dashboard');
    }

    /**
     * Delete comment
     *
     * @param Request $request
     * @param Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
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
