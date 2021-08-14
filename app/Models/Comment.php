<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
       /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 't_comments';

     /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'comment_id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comments',
        'category',
        'user_id',
        'blog_id',
    ];

/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'blog_id',
    ];


     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


     /**
     * Get the blog for the comment.
     */
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }



    /**
     * Get the user for the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
