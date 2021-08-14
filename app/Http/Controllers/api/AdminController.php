<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    private $userService;

    public function __construct( UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getBloggers()
    {
        return $this->userService->getBloggers();
    }



    public function deleteBloggers(Request $request)
    {
        return $this->userService->deleteBlogger($request->input('user_id'));
    }
}
