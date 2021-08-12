<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function showIndexPage() {
        return view('index');
    }
}
