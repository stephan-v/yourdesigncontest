<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use Exception;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    /**
     * Initialize a new comment controller.
     */
    public function __construct()
    {
        $this->authorizeResource(Comment::class, 'comment');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CommentRequest $request The incoming HTTP client request.
     * @param Comment $comment The comment that we want to update.
     * @return Response The server response.
     */
    public function update(CommentRequest $request, Comment $comment)
    {
        $comment->update($request->validated());

        return response($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment The comment that we want to delete.
     * @return Response The server response.
     * @throws Exception Thrown if no primary key is defined on the model.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response('Deleted comment');
    }
}
