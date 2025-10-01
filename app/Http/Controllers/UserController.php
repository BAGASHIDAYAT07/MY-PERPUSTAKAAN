<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjaman;

class UserController extends Controller
{
    public function Home(){
                if (!Auth::check()) {
            session(['redirect_after_login' => url()->current()]);
            return redirect('/login');
        }
        return view("User.HomeUser", ["active" => "HomeUser"]);
    }

    public function Buku(){
                if (!Auth::check()) {
            session(['redirect_after_login' => url()->current()]);
            return redirect('/login');
        }
        return view('admin.buku', ["active" => "buku"]);
    }

    public function Favorit(){
                if (!Auth::check()) {
            session(['redirect_after_login' => url()->current()]);
            return redirect('/login');
        }
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
