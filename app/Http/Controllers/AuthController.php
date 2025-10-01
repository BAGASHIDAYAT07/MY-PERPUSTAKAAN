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
        $user = User::where('email', $request->email)->first();


        if($user==null){
            return back()->withErrors([
            'email' => 'Email tidak di temukan',
        ])->onlyInput('email');
        }

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

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/login');
    }


    public function ViewRegister(){
       return view('register');
    }
}
