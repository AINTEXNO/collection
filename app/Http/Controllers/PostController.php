<?php

namespace App\Http\Controllers;

use App\Actions\StoreUploadFileAction;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderByDesc('id')->get();
        return view('post.index', compact('posts'));
    }

    public function commentsForPost(Post $post)
    {
        $comments = $post->comments;
        return view('post.comments', compact('comments', 'post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StorePostRequest $request
     * @param \App\Actions\StoreUploadFileAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePostRequest $request, StoreUploadFileAction $action)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        $validated['photo'] = $action($request->file('image'));

        Post::create($validated);

        return back()->with(['created' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Post $post)
    {
        $comments = $post->comments()->orderByDesc('id')->get();
        return view('post.show', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdatePostRequest $request
     * @param \App\Models\Post $post
     * @param \App\Actions\StoreUploadFileAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePostRequest $request, Post $post, StoreUploadFileAction $action)
    {
        $validated = $request->validated();

        if($file = $request->file('image')) {
            $validated['photo'] = $action($file);
        }
        $post->update($validated);

        return redirect()->route('admin.posts')->with(['updated' => "Новость \"{$post->title}\" успешно обновлена"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with(['delete' => "Новость \"{$post->title}\" успешно удалена"]);
    }

    public function adminPosts()
    {
        $posts = Post::all();
        return view('admin.posts', compact('posts'));
    }
}
