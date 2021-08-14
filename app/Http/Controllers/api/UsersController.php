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

    public function loginUser(Request $request)
    {
        return $this->userService->findUser($request->input('email'), $request->input('password'));
    }



}
