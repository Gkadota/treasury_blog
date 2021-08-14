<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Blog extends Model
{
      /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 't_blogs';

     /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'blog_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'details',
        'img',
        'category',
        'user_id',
    ];


     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


     /**
     * Get the comments for the blog post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'blog_id', 'blog_id');
    }


    /**
     * Get the blogger info
     */
    public function blogger()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
