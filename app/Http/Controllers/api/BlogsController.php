<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\BlogService;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    //

    private $blogService;

    public function __construct( BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function createBlog(Request $request)
    {
        return $this->blogService->createBlog($request->all());
    }

    public function updateBlog(Request $request)
    {
        return $this->blogService->updateBlog($request->all());
    }

    public function viewBlog(int $blogId)
    {
        return $this->blogService->viewBlog($blogId);
    }


    public function viewBlogList(Request $request)
    {

        return $this->blogService->viewBlogList($request->query('category'), $request->query('search'));
    }

    public function deleteBlog(Request $request)
    {
        return $this->blogService->deleteBlog($request->input('user_id'), $request->input('blog_id'));
    }
}
