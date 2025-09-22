<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserControler extends Controller
{
    public function Home(){
        return view("User.HomeUser");
    }

    public function Favorit(){
        return view("User.Favorit");
    }
}
