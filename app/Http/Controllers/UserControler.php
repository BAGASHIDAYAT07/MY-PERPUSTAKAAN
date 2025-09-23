<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserControler extends Controller
{
    public function Home(){
        return view("User.HomeUser", ["active" => "HomeUser"]);
    }

    public function Buku(){
        return view('admin.buku', ["active" => "buku"]);
    }

    public function Favorit(){
        return view("User.Favorit", ["active" => "Favorit"]);
    }
    public function Peminjaman(){
        return view("User.Peminjaman", ["active" => "Peminjaman"]);
    }
    public function History(){
        return view("User.History", ["active" => "History"]);
    }
}
