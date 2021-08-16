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
            'img'      => ['required',  'image' , 'mimes:jpg,png,jpeg,gif,svg' , 'max:2048'],
            'category' => ['required', 'string', Rule::in(['finance', 'technology', 'business'])],
            'user_id'  => ['required', 'integer', 'exists:t_users']
        ];
    }

    public function updateBlogRules()
    {
        return [
            'user_id'  => ['required', 'integer', 'exists:t_users'],
            'blog_id'  => ['required', 'integer', 'exists:t_blogs'],
            'title'    => ['sometimes', 'string',  'max:30'],
            'details'  => ['sometimes', 'string'],
            'img'      => ['sometimes', 'image' , 'mimes:jpg,png,jpeg,gif,svg' , 'max:2048'],
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
            'category' => ['sometimes', 'nullable', 'string', Rule::in(['finance', 'technology', 'business'])],
            'search'   => ['sometimes', 'nullable', 'string'],
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
