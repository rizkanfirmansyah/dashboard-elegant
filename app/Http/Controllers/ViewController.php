<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    //

    public function home()
    {
        return view('home.index');
    }
    public function login()
    {
        return view('auth.login');
    }
    public function register()
    {
        return view('auth.register');
    }

    public function category()
    {
        $title = 'category';
        return view('master.category', compact('title'));
    }
}
