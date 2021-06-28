<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.role:admin', ['only' => ['blockUser']]);
    }
    public function blockUser()
    {
        return '<b><h1>This is an admin route.</h1></b>';
    }
    public function profile()
    {
        return '<b><h1>This route is for all users.</h1></b>';
    }

}
