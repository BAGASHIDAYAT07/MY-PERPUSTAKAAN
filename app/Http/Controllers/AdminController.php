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

    public function Buku(){
        return view('admin.buku');
    }

    public function User(){
        return view('admin.user');
    }
}
