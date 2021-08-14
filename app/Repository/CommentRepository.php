<?php


namespace App\Repository;

use App\Models\Comment;

class CommentRepository extends BaseRepository
{

    /**
     * Insert  comment
     */
    public function insertComment(array $commentInfo)
    {
        $newComment = Comment::create($commentInfo);

        return $newComment;
    }


    /**
     * Update comment
     */
    public function updateComment(array $commentInfo)
    {
        $updatedComment = Comment::where('comment_id', $commentInfo['comment_id'])
        ->update($commentInfo);

        return $updatedComment;
    }



    /**
     * Delete Comment
     */
    public function deleteComment(int $commentId)
    {
        $deleteResult = Comment::where(['comment_id' => $commentId])->delete();
        return $deleteResult;
    }


}

