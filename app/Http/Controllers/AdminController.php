<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
class AdminController extends Controller
{


    private $userService;

    public function __construct( UserService $userService)
    {
        $this->userService = $userService;
    }

    public function showIndexPage() {
        return view('index');
    }

    public function loginUser(Request $request)
    {

        return $this->userService->login($request->input('email'), $request->input('password'));
    }


    public function logoutUser(Request $request)
    {
        return $this->userService->logoutUser($request->input('email'));

    }







}
