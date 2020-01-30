<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::with('posts')->paginate();

        return view('users.index', [
            'users' => $users
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        $user->load('posts');

        return view('users.show', [
            'user' => $user
        ]);
    }
}
