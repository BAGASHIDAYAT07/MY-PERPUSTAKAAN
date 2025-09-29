<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // ✅ untuk hash password
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Buku;

class AdminController extends Controller
{
    public function Dashboard()
    {
        return view('admin.dashboard', ["active" => "dashboard"]);
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


public function tambahbuku(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string|max:255',
        'JenisBuku' => 'required|string|max:255',
        'Penerbit' => 'required|string|max:255',
        'Pencipta' => 'required|string|max:255',
        'TempatTerbit' => 'required|string|max:255',
        'TahunTerbit' => 'required|integer',
        'JumlahHalaman' => 'required|integer',
        'status' => 'required|boolean',
        'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $fotoUrl = null;

    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $fileName = time() . '_' . $file->getClientOriginalName();

        // Upload ke Supabase
        $response = Http::withHeaders([
            'apikey' => config('services.supabase.key'),
            'Authorization' => 'Bearer ' . config('services.supabase.key'),
        ])->attach(
            'file',
            file_get_contents($file),
            $fileName
        )->post(config('services.supabase.url') . "/storage/v1/object/" . config('services.supabase.bucket') . "/" . $fileName);

        if ($response->successful()) {
            $fotoUrl = config('services.supabase.url') . "/storage/v1/object/public/"
                . config('services.supabase.bucket') . "/" . $fileName;
        }
    }

    Buku::create([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'JenisBuku' => $request->JenisBuku,
        'Penerbit' => $request->Penerbit,
        'Pencipta' => $request->Pencipta,
        'TempatTerbit' => $request->TempatTerbit,
        'TahunTerbit' => $request->TahunTerbit,
        'JumlahHalaman' => $request->JumlahHalaman,
        'status' => $request->status,
        'foto' => $fotoUrl, // 🚀 ini bukan null
    ]);

    return redirect()->route('rakbuku')->with('success', 'Buku berhasil ditambahkan!');
}





    // BUKU
    public function Bukucreate()
    {
        return view('admin.bukus.create');
    }

    public function Bukupdate()
    {
        return view('admin.bukus.update');
    }

    // RAK BUKU
    public function RakBuku()
    {
        return view('admin.RakBuku.RakBuku', ["active" => "rakbuku"]);
    }

    public function Pagenation()
    {
        $user = User::paginate(10); // tampilkan 10 data per halaman
        return view('admin.user', compact('user'));
    }
}


