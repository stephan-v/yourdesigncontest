<?php

namespace App\Http\Controllers;

use Corcel\Model\Post;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View The HTML server response.
     */
    public function index()
    {
        $posts = Post::published()->type('post')->get();

        return view('blog.index', compact('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id The id of the post to show.
     * @return View The HTML server response.
     */
    public function show(int $id)
    {
        $post = Post::find($id);

        return view('blog.show', compact('post'));
    }
}
