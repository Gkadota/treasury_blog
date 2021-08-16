<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\UserService;

class UsersController extends Controller
{

    private $userService;

    public function __construct( UserService $userService)
    {
        $this->userService = $userService;
    }

    public function registerUser(Request $request)
    {
        return $this->userService->createUser($request->all());
    }


    public function updateBlogger(Request $request)
    {
        return $this->userService->updateUser($request->all());
    }




}
