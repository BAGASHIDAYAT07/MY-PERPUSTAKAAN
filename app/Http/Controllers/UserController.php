<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjaman;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;





class UserController extends Controller
{

    public function Buku(){
        $buku = Buku::where('status', 1)->get();
            if (!Auth::check()) {
            session(['redirect_after_login' => url()->current()]);
            return redirect('/login');
        }
        $ses = session()->all();
        if($ses['role'] != 'user'){
            return redirect('/');
        } 
        return view('admin.buku', ["active" => "buku", 'buku' => $buku]);

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
