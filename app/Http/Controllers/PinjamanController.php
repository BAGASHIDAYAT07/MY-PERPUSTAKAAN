<?php

namespace App\Http\Controllers;

use App\Models\pinjaman;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    public function create(){
        return view('peminjaman.create');
    }

    
   public function edit($id)
{
    // $peminjaman = Pinjaman::findOrFail($id);
    return view('peminjaman.update');
}

 public function veriv(){
        return view('peminjaman.verivikasi', ["active" => "veriv"]);
    }


    public function detail(){
        return view('peminjaman.detail');
    }


}
