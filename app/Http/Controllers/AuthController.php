<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller{
    public function home(){
        return view('home');
    }
    public function ViewLogin(){
        return view('login');
    }

    public function ViewRegister(){
       return view('register');
    }
}
