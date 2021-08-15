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

    public function loginUser(Request $request)
    {

        return $this->userService->findUser($request->input('email'), $request->input('password'));
    }


    public function logoutUser(Request $request)
    {
        session()->forget('granter_user');
        return $this->userService->logoutUser($request->input('email'));

    }


}
