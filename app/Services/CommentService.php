<?php

namespace App\Services;

use App\Repository\CommentRepository;
use App\Rules\CommentRules;
use App\Services\BaseService;

class CommentService extends BaseService
{

    private $commentRepo;

    private $commentRules;

    public function __construct(CommentRepository $commentRepo, CommentRules $commentRules)
    {
        $this->commentRepo = $commentRepo;
        $this->commentRules = $commentRules;
    }

    public function createComment($commentInfo)
    {
        $validation = $this->validateRequest($commentInfo, $this->commentRules->insertCommentRules());
        if ($validation['success'] === false) {

            return $this->formatResponse(false, $validation['data']);
        }

        return   $this->formatResponse(true, $this->commentRepo->insertComment($commentInfo)->toArray());
    }

    public function updateComment($commentInfo)
    {
        $validation = $this->validateRequest($commentInfo, $this->commentRules->updateCommentRules());

        if ($validation['success'] === false) {

            return $this->formatResponse(false, $validation['data']);
        }

        return   $this->formatResponse((bool) $this->commentRepo->updateComment($commentInfo));
    }


    public function deleteComment($commentId)
    {
        $validation = $this->validateRequest(['comment_id' => $commentId], $this->commentRules->deleteCommentRules());
        if ($validation['success'] === false) {
            return $this->formatResponse(false, $validation['data']);
        }

        $deleteCommentResult = $this->formatResponse((bool) $this->commentRepo->deleteComment($commentId));
        return $deleteCommentResult;
    }
}
