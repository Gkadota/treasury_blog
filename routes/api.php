<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('blog')->group(function () {
    Route::post('/', 'App\Http\Controllers\api\BlogsController@createBlog');
    Route::put('/', 'App\Http\Controllers\api\BlogsController@updateBlog');
    Route::delete('/', 'App\Http\Controllers\api\BlogsController@deleteBlog');
    Route::get('/{blog_id}', 'App\Http\Controllers\api\BlogsController@viewBlog');
    Route::get('/list/{category}', 'App\Http\Controllers\api\BlogsController@viewBlogList');
});

Route::prefix('comment')->group(function () {
    Route::post('/', 'App\Http\Controllers\api\CommentsController@createComment');
    Route::put('/', 'App\Http\Controllers\api\CommentsController@updateComment');
    Route::delete('/', 'App\Http\Controllers\api\CommentsController@deleteComment');
});

Route::prefix('user')->group(function () {
    Route::post('/', 'App\Http\Controllers\api\UsersController@registerUser');
    Route::post('/login', 'App\Http\Controllers\api\UsersController@loginUser');
    Route::put('/', 'App\Http\Controllers\api\UsersController@updateBlogger');
});

Route::prefix('admin/bloggers')->group(function () {
    Route::get('/', 'App\Http\Controllers\api\AdminController@getBloggers');
    Route::delete('/', 'App\Http\Controllers\api\AdminController@deleteBloggers');
});
