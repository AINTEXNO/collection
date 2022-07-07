<?php

namespace App\Http\Controllers;

use App\Actions\ExtendCommentModelAction;
use App\Actions\GetUserByTokenAction;
use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function index($post, ExtendCommentModelAction $action)
    {
        $findPost = Post::find($post);

        return response()->json([
            'status' => true,
            'data' => [
                'comments' => $action($findPost->comments()->orderByDesc('id')->get())
            ]
        ])->setStatusCode(200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function store(Request $request, GetUserByTokenAction $action, ExtendCommentModelAction $comments)
    {
        $user = $action($request->api_token);
        $post = Post::find($request->post_id);

        $request->merge([
            'user_id' => $user->id
        ]);

        Comment::create($request->all());

        return response()->json([
            'status' => true,
            'data' => [
                'comments' => $comments($post->comments)
            ]
        ])->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Comment $comment)
    {
        return view('comment.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Actions\GetUserByTokenAction $action
     * @param \App\Actions\ExtendCommentModelAction $comments
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, GetUserByTokenAction $action, ExtendCommentModelAction $comments): \Illuminate\Http\JsonResponse
    {
        $user = $action($request->api_token);
        $comment = Comment::find($request->comment_id);
        $post = Post::find($request->post_id);

        if($comment->user->id == $user->id) {
            $comment->delete();

            return response()->json(['status' => true, 'data' => ['comments' => $comments($post->comments)]]);
        }

        return response()->json(['status' => false]);
    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Comment $comment): \Illuminate\Http\RedirectResponse
    {
        $comment->delete();
        return back()->with(['delete' => true]);
    }
}
