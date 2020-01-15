<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function show($id)
    {
        return view('user', ['user' => User::findOrFail($id)]);
    }

    public function index()
    {
        return view('users');
    }
}
