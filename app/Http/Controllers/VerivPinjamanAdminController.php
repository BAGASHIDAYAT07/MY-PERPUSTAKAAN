<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerivPinjamanAdminController extends Controller
{
    public function veriv(){
         if (!Auth::check()) {
            session(['redirect_after_login' => url()->current()]);
            return redirect('/login');
        }
        $ses = session()->all();
        if($ses['role'] != 'admin'){
            return redirect('/buku');
        }
        return view('peminjaman.verivikasi', ["active" => "veriv"]);
    }
}
