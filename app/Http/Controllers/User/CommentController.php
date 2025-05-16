<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;

class CommentController extends Controller
{
    /**
     * Displays a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Shows the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Stores a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostFormRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    //commenting on user posts: if the user is friends with another user then posts and comments are visible to each other//
    public function store(PostFormRequest $request, Post $post) {
        if((auth()->user()->id != $request->user_id) && (!auth()->user()->is_friends_with($request->user_id))) {
            return back();
        }
        if((auth()->user()->id != $request->user_id) && (auth()->user()->is_friends_with($request->user_id))) {
            auth()->user()->comments()->create([
                'body' => $request->body,
                'post_id' => $post->id,
            ]);
            return back();
        }
        if((auth()->user()->id = $request->user_id)) {
            auth()->user()->comments()->create([
                'body' => $request->body,
                'post_id' => $post->id,
            ]);
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Shows the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
