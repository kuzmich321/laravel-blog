<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

class IndexController extends Controller
{
    /**
     * @return Renderable
     */
    public function index()
    {
        return view('index');
    }
}
