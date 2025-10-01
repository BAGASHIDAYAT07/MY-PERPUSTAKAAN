<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjaman;
use App\Models\Buku;

class UserController extends Controller
{
    public function Home(){
        return view("User.HomeUser", ["active" => "HomeUser"]);
    }

    public function Buku(){
        $buku = Buku::where('status', 1)->get();
        return view('admin.buku', ["active" => "buku", 'buku' => $buku]);
    }

    public function Favorit(){
        return view("User.Favorit", ["active" => "Favorit"]);
    }
    public function History()
{
    $histories = Pinjaman::with(['buku','user'])
        ->orderBy('created_at','desc')
        ->get();

    return view('User.History', compact('histories')
        , ["active" => "History"]
);
}

}
