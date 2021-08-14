<?php

namespace App\Rules;

use Illuminate\Validation\Rule;

class BlogRules extends BaseRules
{
    public function insertBlogRules()
    {
        return [
            'title'    => ['required', 'string',  'max:30'],
            'details'  => ['required', 'string'],
            'img'      => ['required', 'string'],
            'category' => ['required', 'string', Rule::in(['finance', 'technology', 'business'])],
            'user_id'  => ['required', 'integer', 'exists:t_users']
        ];
    }

    public function updateBlogRules()
    {
        return [
            'blog_id'  => ['required', 'integer', 'exists:t_blogs'],
            'title'    => ['sometimes', 'string',  'max:30'],
            'details'  => ['sometimes', 'string'],
            'img'      => ['sometimes', 'string'],
            'category' => ['sometimes', 'string', Rule::in(['finance', 'technology', 'business'])],
        ];
    }


    public function viewBlogRules()
    {
        return [
            'blog_id'  => ['required', 'integer', 'exists:t_blogs']
        ];
    }


    public function blogListRules()
    {
        return [
            'category'   => ['required', 'string', Rule::in(['all', 'finance', 'technology', 'business'])],
        ];
    }

    public function deleteBlogRules()
    {
        return [
            'user_id'  => ['required', 'integer', 'exists:t_users'],
            'blog_id'  => ['required', 'integer', 'exists:t_blogs']
        ];
    }
}
