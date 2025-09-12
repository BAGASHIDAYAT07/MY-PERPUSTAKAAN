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
    
    public function usecreate(){
        return view('admin.user.creat');
    }

    public function UserUpdate(){
        return view('admin.user.update');
    }
    
    public function Bukucreate(){
        return view('admin.bukus.create');
    }

    public function Bukupdate(){
        return view('admin.bukus.update');
    }
}
