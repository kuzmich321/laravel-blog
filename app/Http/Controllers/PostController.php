<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts = Post::with('user')->paginate();

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function show(Post $post)
    {
        $post->load('user');

        return view('posts.show', [
            'post' => $post
        ]);
    }
}
