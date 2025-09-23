<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
        $user = User::all();
        return view('admin.user', ["active" => "user", "user" => $user]);
    }
    
    // public function usecreate(){
    //     return view('admin.user.creat');
    // }
    
    // public function UserUpdate(){
    //     return view('admin.user.update');
    // }
  
    public function VerifikasiUser(){
        return view('admin.user.VerifikasiUser', ["active" => "verifikasiuser"]);
    }

    public function UserCreates(Request $request){
        $name = $request->namaLengkap;
        $email = $request->email;
        $nis = $request->nis;
        $gender = $request->gender;
        $status = $request->status;
        $password = $request->password;

        // dd($name, $email, $nis, $gender, $status, $password);

        // if($name == "" || $email == "" || $nis == "" || $gender == "" || $status == "" || $password == ""){
        //     return redirect()->back()->with('error', 'Data tidak boleh kosong');
        // }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'NIS' => $nis,
            'jenisKelamin' => $gender,
            'status' => $status,
            'password' => $password,
        ]);
    
        if ($user) {
            return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Data Gagal Ditambahkan');
        }
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
