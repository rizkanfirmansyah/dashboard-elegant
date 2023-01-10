<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    //

    public function home()
    {
        $title = 'hehe';
        return view('home.index', compact('title'));
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
