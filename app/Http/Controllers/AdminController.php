<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function Dashboard(){
        return view('admin.dashboard', ["active" => "dashboard"]);
    }

    public function tes(){
        return view('peminjaman.index');
    }

    
    // USER
    public function User(){
        return view('admin.user', ["active" => "user"]);
    }
    
    public function usecreate(){
        return view('admin.user.creat');
    }
    
    public function UserUpdate(){
        return view('admin.user.update');
    }
  
    public function VerifikasiUser(){
        return view('admin.user.VerifikasiUser', ["active" => "verifikasiuser"]);
    }
    

    // BUKU
  
    public function Bukucreate(){
        return view('admin.bukus.create');
    }
    
    public function Bukupdate(){
        return view('admin.bukus.update');
    }
  
  
    // RAK BUKU
    public function RakBuku(){
        return view('admin.RakBuku.RakBuku', ["active" => "rakbuku"]);
    }
}
