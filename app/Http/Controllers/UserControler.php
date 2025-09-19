<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserControler extends Controller
{
    public function Buku(){
        return view("User.Buku");
    }
}
