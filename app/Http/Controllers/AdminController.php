<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function Dashboard(){
        return view('admin.dashboard');
    }

    public function tes(){
        return view('peminjaman.index');
    }

     public function create(){
        return view('peminjaman.create');
    }
    
//   public function edit($id) {
//     $peminjaman = Peminjaman::findOrFail($id);
//     return view('peminjaman.update', compact('peminjaman'));
// }
}
