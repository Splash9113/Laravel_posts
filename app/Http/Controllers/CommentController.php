<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(StoreCommentRequest $request, Post $post)
    {
        (Auth::user())->comments()->create($request->all() + ['post_id' => $post->id]);
        return back();
    }

    public function destroy(Post $post, Comment $comment)
    {
        if (!policy($comment)->destroy(Auth::user(), $comment, $post)) {
            abort(403);
        }
//        if (Gate::denies('destroy', [$comment, $post])) {
//            return view('errors.403');
//        }
        $comment->delete();
        return back();
    }
}
