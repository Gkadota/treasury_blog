<?php


namespace App\Repository;

use App\Models\Blog;
use App\Models\Comment;

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
        $foundBlog =  Blog::where('blog_id', $blogId)
        ->with('comments', 'comments.user')
        ->with('blogger')
        ->first()->toArray();

        $comments = Comment::where('blog_id', $blogId)
        ->with('user')
        ->orderBy('comment_id', 'desc')
        ->get();

        $foundBlog['comments'] = $comments;

         return $foundBlog;
    }


    /**
     * Fetch list of blogs
     */
    public function getBlogList(string $category = null, string $searchQuery = null)
    {
        $blogs = Blog::when($category !== null, function ($query) use ($category) {
            $query->where('category', $category);
            })
            ->when($searchQuery !== null, function ($query) use ($searchQuery) {
                $query->where('title', 'LIKE', '%' . $searchQuery . '%');
            })
            ->with('blogger')
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
