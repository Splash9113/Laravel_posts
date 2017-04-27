<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Post $post)
    {
        (Auth::user())->comments()->create($request->all() + ['post_id' => $post->id]);
        return back();
    }

    public function destroy(Post $post, Comment $comment)
    {
        if (Gate::denies('destroy', [$comment, $post])) {
            return view('errors.403');
        }
        $comment->delete();
        return back();
    }
}
