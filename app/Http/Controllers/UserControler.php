<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserControler extends Controller
{
    public function Buku(){
        return view("User.Home");
    }
    
    public function Favorit(){
        return view("User.Favorit");
    }
}
