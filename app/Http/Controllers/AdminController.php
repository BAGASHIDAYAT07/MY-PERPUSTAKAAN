<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // ✅ untuk hash password
use Illuminate\Support\Facades\Http;
use App\Models\User;

class AdminController extends Controller
{
    public function Dashboard()
    {
        return view('admin.dashboard', ["active" => "dashboard"]);
    }

    public function tes()
    {
        return view('peminjaman.index');
    }

    // USER
    public function User()
    {
        $user = User::all();
        return view('admin.user', ["active" => "user", "user" => $user]);
    }

    public function VerifikasiUser()
    {
        return view('admin.user.VerifikasiUser', ["active" => "verifikasiuser"]);
    }

    public function UserCreates(Request $request)
{
    // ✅ Validasi form
    $request->validate([
        'namaLengkap' => 'required|string|max:255',
        'email'       => 'required|email|unique:users,email',
        'nis'         => 'required|unique:users,NIS',
        'gender'      => 'required',
        'status'      => 'required',
        'password'    => 'required|min:6',
    ], [
        // Pesan khusus jika data kosong
        'namaLengkap.required' => 'Nama lengkap tidak boleh kosong',
        'email.required'       => 'Email tidak boleh kosong',
        'nis.required'         => 'NIS tidak boleh kosong',
        'gender.required'      => 'Jenis kelamin harus dipilih',
        'status.required'      => 'Status harus dipilih',
        'password.required'    => 'Password tidak boleh kosong',
        'password.min'         => 'Password minimal 6 karakter',
        'email.email'          => 'Format email tidak valid',
        'email.unique'         => 'Email sudah terdaftar',
        'nis.unique'           => 'NIS sudah digunakan',
    ]);

    // ✅ Simpan data user ke database
    $user = User::create([
        'name'         => $request->namaLengkap,
        'email'        => $request->email,
        'NIS'          => $request->nis,
        'jenisKelamin' => $request->gender,
        'status'       => $request->status,
        'password'     => Hash::make($request->password), // password terenkripsi
    ]);

    // ✅ Feedback ke user
    if ($user) {
        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    } else {
        return redirect()->back()->with('error', 'Data gagal ditambahkan');
    }
}


public function toggleStatus($id)
{
    $user = User::findOrFail($id);

    // Ubah status: kalau 1 jadi 0, kalau 0 jadi 1
    $user->status = $user->status == 1 ? 0 : 1;
    $user->save();

    return redirect()->back()->with('success', 'Status user berhasil diubah!');
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'namaLengkap' => 'required|string|max:255',
        'email'       => 'required|email|unique:users,email,' . $id,
        'nis'         => 'required|unique:users,NIS,' . $id,
        'gender'      => 'required',
        'status'      => 'required|in:0,1',
    ]);

    $user->name         = $request->namaLengkap;
    $user->email        = $request->email;
    $user->NIS          = $request->nis;
    $user->jenisKelamin = $request->gender;
    $user->status       = $request->status;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->back()->with('success', 'Data user berhasil diperbarui');
}

}


