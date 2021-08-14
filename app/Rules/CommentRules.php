<?php

namespace App\Rules;

use Illuminate\Validation\Rule;

class CommentRules extends BaseRules
{
    public function insertCommentRules()
    {
        return [
            'user_id'  => ['required', 'integer', 'exists:t_users'],
            'blog_id'  => ['required', 'integer', 'exists:t_blogs'],
            'comments'  => ['required', 'string'],
        ];
    }


    public function updateCommentRules()
    {
        return [
            'comment_id'  => ['required', 'integer', 'exists:t_comments'],
            'comments'  => ['required', 'string'],
        ];
    }


    public function deleteCommentRules()
    {
        return [
            'comment_id'  => ['required', 'integer', 'exists:t_comments'],
        ];
    }

}
