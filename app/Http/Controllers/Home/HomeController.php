<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public static function index(){

        return view('index');

    }

    public static function login(){

        return view('userpage.login');

    }

    public static function register(){

        return view('userpage.register');

    }

    public static function cart(){

        return view('userpage.cart');

    }

}
