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
    try {
        // 🔹 Validasi input
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => [
                'required',
                'email',
                'unique:users,email',
                'regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/', // ✅ hanya @gmail.com
            ],
            'password'     => 'required|min:6',
            'NIS'          => [
                'required',
                'digits:10', // ✅ harus tepat 10 digit
            ],
            'jenisKelamin' => 'required|string',
            'nomorwa'      => [
                'required',
                'regex:/^(\+62|08)[0-9]{9,13}$/', // ✅ mulai +62 / 08 dan total 11–15 digit
                'unique:users,nomorwa',
            ],
        ], [
            // 🔹 Pesan error custom
            'email.regex' => 'Email harus menggunakan domain @gmail.com.',
            'NIS.digits' => 'NIS harus terdiri dari tepat 10 digit angka.',
            'nomorwa.regex' => 'Nomor WhatsApp harus diawali dengan +62 atau 08 dan memiliki panjang 11–15 digit.',
            'nomorwa.unique' => 'Nomor WhatsApp ini sudah terdaftar.',
        ]);

        // 🔹 Simpan ke database
        User::create([
            'name'         => $validated['name'],
            'email'        => $validated['email'],
            'password'     => Hash::make($validated['password']),
            'NIS'          => $validated['NIS'],
            'jenisKelamin' => $validated['jenisKelamin'],
            'nomorwa'      => $validated['nomorwa'],
            'status'       => 0, // belum aktif
        ]);

        // 🔹 Arahkan ke login
        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan tunggu admin untuk mengonfirmasi akun Anda.');

    } catch (\Illuminate\Validation\ValidationException $e) {
        // 🔹 Ambil semua pesan error jadi satu string
        $errorMessages = implode(' ', $e->validator->errors()->all());

        // 🔹 Kirim balik ke halaman register dengan session error
        return back()->withInput()->with('error', $errorMessages);
    }
}


}
