<?php


namespace App\Repository;

use App\Models\Blog;

class BlogRepository extends BaseRepository
{

    /**
     * Insert new Blog
     */
    public function insertBlog(array $blogInfo)
    {
        $newBlog = Blog::create($blogInfo);

        return $newBlog;
    }


    /**
     * Update  Blog
     */
    public function updateBlog(array $blogInfo)
    {
        $updatedBlog = Blog::where('blog_id', $blogInfo['blog_id'])
        ->update($blogInfo);

        return $updatedBlog;
    }


    /**
     * View Blog with comments
     */
    public function findBlog(int $blogId)
    {
        return Blog::where('blog_id' , $blogId)->with('comments', 'comments.user')->with('blogger')->first();
    }


    /**
     * Fetch list of blogs
     */
    public function getBlogList(string $category)
    {
        $blogs = Blog::when($category !== 'all', function($query) use ($category) {
            $query->where('category', $category);
        })
        ->orderBy('blog_id', 'desc')
        ->get();

        return $blogs;
    }





    /**
     * Delete blog
     */
    public function deleteBlog(int $userId, int $blogId)
    {
        $deleteResult = Blog::where(['user_id' => $userId, 'blog_id' => $blogId])->delete();
        return $deleteResult;
    }


}

