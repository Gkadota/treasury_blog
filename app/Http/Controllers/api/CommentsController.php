<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    private $commentService;

    public function __construct( CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function createComment(Request $request)
    {
        return $this->commentService->createComment($request->all());
    }


    public function updateComment(Request $request)
    {
        return $this->commentService->updateComment($request->all());
    }


    public function deleteComment(Request $request)
    {
        return $this->commentService->deleteComment($request->input('comment_id'));
    }
}
