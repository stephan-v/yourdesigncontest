<?php

namespace App\Http\Controllers;

use App\Services\WordPress;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param WordPress $wordPress The WordPress API layer.
     * @return View The HTML server response.
     */
    public function index(WordPress $wordPress)
    {
        $posts = $wordPress->posts();
        $categories = $wordPress->categories();

        // Set the object keys as the array index.
        $lookup = array_column($categories, NULL, 'id');

        foreach ($posts as $post) {
            $post->category = $lookup[$post->categories[0]]->name;
            $post->image = $post->_embedded->{'wp:featuredmedia'}[0]->media_details->sizes->large->source_url;
        }

        return view('blog.index', compact('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id The id of the post to show.
     * @param WordPress $wordPress The WordPress API layer.
     * @return View The HTML server response.
     */
    public function show(int $id, WordPress $wordPress)
    {
        $post = $wordPress->post($id);

        return view('blog.show', compact('post'));
    }
}
