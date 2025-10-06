<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller{
    
    public function ViewLogin(){
        if (Auth::check()) {
            session(['redirect_after_login' => url()->current()]);
            return redirect('/');
        }
        return view('login');
    }

     public function login(Request $request)
    {
        // Validasi form login
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Jika user tidak ditemukan
        if (!$user) {
            return back()->with('error', 'Email atau password salah.');
        }

        // Cek apakah status user aktif (status = 1)
        if ($user->status != 1) {
            return back()->with('error', 'Akun Anda status nonaktif. Hubungi admin untuk mengaktifkan akun Anda.');
        }

        // Cek apakah password cocok
        if (Auth::attempt($credentials)) {
            session(['role' => $user->role]);
            session(['id' => $user->id]);

            if ($user->role == 'admin') {
                return redirect()->intended('/')->with('success', 'Berhasil login sebagai Admin.');
            } else {
                return redirect()->intended('/buku')->with('success', 'Berhasil login sebagai User.');
            }
        }

        // Jika password salah
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
        }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/login')->with('success', 'Anda berhasil logout.');
    }


    public function ViewRegister(){
       return view('register');
    }

    public function register(Request $request)
{
    // Validasi input
    $request->validate([
        'name'         => 'required|string|max:255',
        'email'        => 'required|email|unique:users,email',
        'password'     => 'required|min:6',
        'NIS'          => 'required|string|max:20',
        'jenisKelamin' => 'required|string',
    ]);

    // Simpan ke database
    User::create([
        'name'         => $request->name,
        'email'        => $request->email,
        'password'     => Hash::make($request->password),
        'NIS'          => $request->NIS,
        'jenisKelamin' => $request->jenisKelamin,
        // 'role'         => 'admin', // bisa kamu ubah kalau mau register user biasa
    ]);

    // Arahkan ke login
    return redirect('/login')->with('success', 'Registrasi berhasil. Silahkan tunggu admin untuk mengonfirmasi akun Anda.');
    }

}
