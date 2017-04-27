<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    protected $postsService;

    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $active = $request->input('active', true);
        return view('post.posts', [
            'posts' => Post::active($active)->get(),
            'active' => $active
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * @param StorePostRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StorePostRequest $request)
    {
        (Auth::user())->posts()->create($request->all());

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', ['post' => $post, 'comments' => $post->comments()->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (Gate::denies('update', $post)) {
            return view('errors.403');
        }
        return view('post.edit', ['post' => $post, 'comments' => $post->comments()->get()]);
    }

    /**
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        if (Gate::denies('update', $post)) {
            return view('errors.403');
        }
        $data = $request->all();
        $data['active'] = $data['active'] ?? '0';
        $post->update($data);
        return redirect()->route('posts.index', ['active' => $request->input('active', true)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post)
    {
        if (Gate::denies('destroy', $post)) {
            return view('errors.403');
        }
        $post->delete();
        return redirect()->route('posts.index', ['active' => $request->input('active', true)]);
    }
}
