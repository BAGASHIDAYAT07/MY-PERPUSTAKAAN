<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller{
    
    public function ViewLogin(){
        return view('login');
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if($user->status === 0){
            return back()->withErrors([
             'status' => 'Akun ada telah di nonaktifkan',
            ])->onlyInput('status');
        }
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/')
                             ->with('success', 'Berhasil login');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }


    public function ViewRegister(){
       return view('register');
    }
}
