<?php

namespace App\Services;

use App\Repository\BlogRepository;
use App\Rules\BlogRules;
use App\Rules\UserRules;
use App\Services\BaseService;

class BlogService extends BaseService
{

    private $blogRepo;

    private $blogRules;

    public function __construct(BlogRepository $blogRepo, BlogRules $blogRules)
    {
        $this->blogRepo = $blogRepo;
        $this->blogRules = $blogRules;
    }

    public function createBlog($blogInfo)
    {
        $validation = $this->validateRequest($blogInfo, $this->blogRules->insertBlogRules());
        if ($validation['success'] === false) {

            return $this->formatResponse(false, $validation['data']);
        }

        return   $this->formatResponse(true, $this->blogRepo->insertBlog($blogInfo)->toArray());
    }

    public function updateBlog($blogInfo)
    {
        $validation = $this->validateRequest($blogInfo, $this->blogRules->updateBlogRules());

        if ($validation['success'] === false) {

            return $this->formatResponse(false, $validation['data']);
        }

        return   $this->formatResponse((bool) $this->blogRepo->updateBlog($blogInfo));
    }


    public function viewBlog($blogId)
    {
        $validation = $this->validateRequest(['blog_id' => $blogId], $this->blogRules->viewBlogRules());

        if ($validation['success'] === false) {
            return $this->formatResponse(false, $validation['data']);
        }

        $foundBlog =  $this->blogRepo->findBlog($blogId);
        return $this->formatResponse(true, $foundBlog->toArray());
    }


    public function viewBlogList($category, $searchQuery)
    {
        $validation = $this->validateRequest([
            'category' => $category,
            'search' => $searchQuery,
        ], $this->blogRules->blogListRules());

        if ($validation['success'] === false) {
            return $this->formatResponse(false, $validation['data']);
        }

        $blogList =  $this->blogRepo->getBlogList($category, $searchQuery);

        if ($blogList === null) {
            return $this->formatResponse(false, ['message' => 'No blog found']);
        }

        return $this->formatResponse(true, $blogList->toArray());
    }


    public function deleteBlog($userId,  $blogId)
    {
        $validation = $this->validateRequest([
            'user_id' => $userId,
            'blog_id' => $blogId
        ], $this->blogRules->deleteBlogRules());
        if ($validation['success'] === false) {

            return $this->formatResponse(false, $validation['data']);
        }

        return   $this->formatResponse((bool) $this->blogRepo->deleteBlog($userId, $blogId));
    }
}
