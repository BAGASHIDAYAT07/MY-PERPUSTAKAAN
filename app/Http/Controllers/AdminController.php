<?php

namespace App\Http\Controllers;

use App\Models\Peminjamans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // ✅ untuk hash password
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Facades\DB; 

class AdminController extends Controller
{
// public function Dashboard(Request $request)
// {
//     if (!Auth::check()) {
//         session(['redirect_after_login' => url()->current()]);
//         return redirect('/login');
//     }

//     $ses = session()->all();
//     if ($ses['role'] != 'admin') {
//         return redirect('/buku');
//     }

//     // Tahun aktif (default = tahun sekarang)
//     $tahun = $request->get('tahun', date('Y'));

//     // Jumlah data dasar
//     $jumlahUser = User::count();
//     $jumlahBuku = Buku::count();

//     // Jumlah total peminjaman dan pengembalian per tahun
//     $jumlahPeminjaman = Peminjamans::whereYear('tanggal_pinjam', $tahun)->count();
//     $jumlahPengembalian = Peminjamans::whereYear('tanggal_kembali', $tahun)
//         ->where('status', 'Dikembalikan')
//         ->count();

//     // === 📊 Data Per Bulan untuk Chart ===
//     $peminjamanPerBulan = [];
//     $pengembalianPerBulan = [];

//     for ($bulan = 1; $bulan <= 12; $bulan++) {
//         $peminjamanPerBulan[] = Peminjamans::whereYear('tanggal_pinjam', $tahun)
//             ->whereMonth('tanggal_pinjam', $bulan)
//             ->count();

//         $pengembalianPerBulan[] = Peminjamans::whereYear('tanggal_kembali', $tahun)
//             ->whereMonth('tanggal_kembali', $bulan)
//             ->where('status', 'Dikembalikan')
//             ->count();
//     }

//     // Kirim ke view
//     return view('admin.dashboard', [
//         "active" => "dashboard",
//         "jumlahUser" => $jumlahUser,
//         "jumlahBuku" => $jumlahBuku,
//         "jumlahPeminjaman" => $jumlahPeminjaman,
//         "jumlahPengembalian" => $jumlahPengembalian,
//         "peminjamanPerBulan" => json_encode($peminjamanPerBulan),
//         "pengembalianPerBulan" => json_encode($pengembalianPerBulan), 
//         "tahun" => $tahun,
//     ]);
// }

public function Dashboard(Request $request)
{
    if (!Auth::check()) {
        session(['redirect_after_login' => url()->current()]);
        return redirect('/login');
    }

    $ses = session()->all();
    if ($ses['role'] != 'admin') {
        return redirect('/buku');
    }

    // Tahun & bulan aktif (default: sekarang)
    $tahun = $request->get('tahun', date('Y'));
    $bulan = $request->get('bulan', date('m'));

    // Statistik utama
    $jumlahUser = User::count();
    $jumlahBuku = Buku::count();
    $jumlahPeminjaman = Peminjamans::whereYear('tanggal_pinjam', $tahun)->count();
    $jumlahPengembalian = Peminjamans::whereYear('tanggal_kembali', $tahun)
        ->where('status', 'Dikembalikan')
        ->count();

    // Data bulanan untuk chart
    $peminjamanPerBulan = [];
    $pengembalianPerBulan = [];
    for ($b = 1; $b <= 12; $b++) {
        $peminjamanPerBulan[] = Peminjamans::whereYear('tanggal_pinjam', $tahun)
            ->whereMonth('tanggal_pinjam', $b)
            ->count();

        $pengembalianPerBulan[] = Peminjamans::whereYear('tanggal_kembali', $tahun)
            ->whereMonth('tanggal_kembali', $b)
            ->where('status', 'Dikembalikan')
            ->count();
    }

    // Data harian bulan aktif
    $dataHarian = $this->getDataHarian($tahun, $bulan);

    return view('admin.dashboard', [
        "active" => "dashboard",
        "jumlahUser" => $jumlahUser,
        "jumlahBuku" => $jumlahBuku,
        "jumlahPeminjaman" => $jumlahPeminjaman,
        "jumlahPengembalian" => $jumlahPengembalian,
        "peminjamanPerBulan" => json_encode($peminjamanPerBulan),
        "pengembalianPerBulan" => json_encode($pengembalianPerBulan),
        "dataHarian" => $dataHarian,
        "tahun" => $tahun,
        "bulan" => $bulan,
    ]);
}

//
// === JSON API untuk AJAX dashboard (filter tahun & bulan) ===
//
public function DashboardData($tahun, $bulan = null)
{
    $jumlahPeminjaman = Peminjamans::whereYear('tanggal_pinjam', $tahun)->count();
    $jumlahPengembalian = Peminjamans::whereYear('tanggal_kembali', $tahun)
        ->where('status', 'Dikembalikan')
        ->count();

    // Data per bulan untuk chart
    $peminjamanPerBulan = [];
    $pengembalianPerBulan = [];
    for ($b = 1; $b <= 12; $b++) {
        $peminjamanPerBulan[] = Peminjamans::whereYear('tanggal_pinjam', $tahun)
            ->whereMonth('tanggal_pinjam', $b)
            ->count();

        $pengembalianPerBulan[] = Peminjamans::whereYear('tanggal_kembali', $tahun)
            ->whereMonth('tanggal_kembali', $b)
            ->where('status', 'Dikembalikan')
            ->count();
    }

    // Gunakan bulan terakhir yang punya data jika belum dipilih
    $bulanAktif = $bulan ?? Peminjamans::whereYear('tanggal_pinjam', $tahun)
        ->selectRaw('MONTH(tanggal_pinjam) as bulan')
        ->orderByDesc('bulan')
        ->value('bulan') ?? date('m');

    // Ambil data harian berdasarkan bulan aktif
    $dataHarian = $this->getDataHarian($tahun, $bulanAktif);

    return response()->json([
        'jumlahPeminjaman' => $jumlahPeminjaman,
        'jumlahPengembalian' => $jumlahPengembalian,
        'peminjamanPerBulan' => $peminjamanPerBulan,
        'pengembalianPerBulan' => $pengembalianPerBulan,
        'dataHarian' => $dataHarian,
    ]);
}

//
// === Fungsi bantu ambil data harian ===
//
private function getDataHarian($tahun, $bulan)
{
    $peminjaman = Peminjamans::selectRaw('DATE(tanggal_pinjam) as tanggal, COUNT(*) as total_peminjaman')
        ->whereYear('tanggal_pinjam', $tahun)
        ->whereMonth('tanggal_pinjam', $bulan)
        ->groupBy('tanggal')
        ->get();

    $pengembalian = Peminjamans::selectRaw('DATE(tanggal_kembali) as tanggal, COUNT(*) as total_pengembalian')
        ->whereYear('tanggal_kembali', $tahun)
        ->whereMonth('tanggal_kembali', $bulan)
        ->where('status', 'Dikembalikan')
        ->groupBy('tanggal')
        ->get();

    $tanggalUnik = $peminjaman->pluck('tanggal')->merge($pengembalian->pluck('tanggal'))->unique()->sort();

    $data = [];
    foreach ($tanggalUnik as $tgl) {
        $data[] = [
            'tanggal' => $tgl,
            'total_peminjaman' => $peminjaman->firstWhere('tanggal', $tgl)->total_peminjaman ?? 0,
            'total_pengembalian' => $pengembalian->firstWhere('tanggal', $tgl)->total_pengembalian ?? 0,
        ];
    }

    return $data;
}





    // USER
    public function User()
    {
            if (!Auth::check()) {
            session(['redirect_after_login' => url()->current()]);
            return redirect('/login');
        }
        $ses = session()->all();
        if($ses['role'] != 'admin'){
            return redirect('/buku');
        }

        $user = User::where('veriv', 1)
            ->where('role', 'user') 
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.user', ["active" => "user", "user" => $user]);
    }


    public function UserCreates(Request $request)
    {
        try {
            // ✅ Validasi input
            $validated = $request->validate([
                'namaLengkap' => 'required|string|max:255',
                'email'       => 'required|email|unique:users,email',
                'nis'         => 'required|digits:10|unique:users,nis',
                'gender'      => 'required',
                'status'      => 'required|in:0,1',
                'password'    => 'required|min:6',
                'nomorwa'     => ['required', 'regex:/^(?:\+62|0)8\d{8,11}$/'],
            ], [
                'namaLengkap.required' => 'Nama lengkap tidak boleh kosong.',
                'email.required'       => 'Email wajib diisi.',
                'email.email'          => 'Format email tidak valid.',
                'email.unique'         => 'Email sudah terdaftar.',
                'nis.required'         => 'NIS wajib diisi.',
                'nis.digits'           => 'NIS harus terdiri dari 10 digit angka.',
                'nis.unique'           => 'NIS sudah digunakan.',
                'gender.required'      => 'Jenis kelamin wajib diisi.',
                'status.required'      => 'Status wajib diisi.',
                'password.required'    => 'Password wajib diisi.',
                'password.min'         => 'Password minimal 6 karakter.',
                'nomorwa.required'     => 'Nomor WhatsApp wajib diisi.',
                'nomorwa.regex'        => 'Nomor WhatsApp harus diawali dengan 08 atau +62 dan terdiri dari 10–13 digit.',
            ]);

            // ✅ Simpan user baru
            User::create([
                'name'         => $validated['namaLengkap'],
                'email'        => $validated['email'],
                'NIS'          => $validated['nis'],
                'jenisKelamin' => $validated['gender'],
                'status'       => $validated['status'],
                'password'     => Hash::make($validated['password']),
                'nomorwa'      => $validated['nomorwa'],
                'veriv'        => 1
            ]);

            return redirect()->back()->with('success', 'Data user berhasil ditambahkan!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errorMessages = implode(' ', $e->validator->errors()->all());
            return back()->withInput()->with('error', $errorMessages);
        }
    }

    // =======================
    // 🔹 UBAH STATUS USER
    // =======================
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();

        return redirect()->back()->with('success', 'Status user berhasil diubah!');
    }

    // =======================
    // 🔹 UPDATE USER
    // =======================
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        try {
            $validated = $request->validate([
                'namaLengkap' => 'required|string|max:255',
                'email'       => ['required', 'email', Rule::unique('users', 'email')->ignore($id)],
                'nis'         => ['required', 'digits:10', Rule::unique('users', 'nis')->ignore($id)],
                'gender'      => 'required',
                'status'      => 'required|in:0,1',
                'password'    => 'nullable|min:6',
                'nomorwa'     => ['required', 'regex:/^(?:\+62|0)8\d{8,11}$/'],
            ], [
                'namaLengkap.required' => 'Nama lengkap wajib diisi.',
                'email.required'       => 'Email wajib diisi.',
                'email.email'          => 'Format email tidak valid.',
                'email.unique'         => 'Email sudah digunakan oleh akun lain.',
                'nis.required'         => 'NIS wajib diisi.',
                'nis.digits'           => 'NIS harus terdiri dari 10 digit angka.',
                'nis.unique'           => 'NIS sudah digunakan oleh akun lain.',
                'gender.required'      => 'Jenis kelamin wajib diisi.',
                'status.required'      => 'Status wajib diisi.',
                'password.min'         => 'Password minimal 6 karakter.',
                'nomorwa.required'     => 'Nomor WhatsApp wajib diisi.',
                'nomorwa.regex'        => 'Nomor WhatsApp harus diawali dengan 08 atau +62 dan terdiri dari 10–13 digit.',
            ]);

            // ✅ Update data user
            $user->update([
                'name'         => $validated['namaLengkap'],
                'email'        => $validated['email'],
                'NIS'          => $validated['nis'],
                'jenisKelamin' => $validated['gender'],
                'status'       => $validated['status'],
                'nomorwa'      => $validated['nomorwa'],
                'password'     => $request->filled('password')
                    ? Hash::make($validated['password'])
                    : $user->password,
            ]);

            return redirect()->back()->with('success', 'Data user berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errorMessages = implode(' ', $e->validator->errors()->all());
            return back()->withInput()->with('error', $errorMessages);
        }
    }
}


