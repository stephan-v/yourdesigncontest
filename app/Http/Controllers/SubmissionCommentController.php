<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Submission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubmissionCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Submission $submission The submission to attach the comment to.
     * @param Request $request The server request.
     * @return Response The server response.
     */
    public function store(Submission $submission, Request $request)
    {
        $data = $request->validate([
            'comment' => ['required', 'string'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $comment = $submission->comments()->create($data);

        return response($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}