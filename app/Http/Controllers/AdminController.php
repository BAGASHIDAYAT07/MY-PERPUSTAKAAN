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

        $user = User::where('veriv', 1)->paginate(10);
        return view('admin.user', ["active" => "user", "user" => $user]);
    }


public function UserCreates(Request $request)
{
    $request->validate([
        'namaLengkap' => 'required|string|max:255',
        'email'       => 'required|email|unique:users,email',
        'nis'         => 'required|unique:users,NIS',
        'gender'      => 'required',
        'status'      => 'required',
        'password'    => 'required|min:6',
    ], [
        // ✳️ Pesan error custom
        'namaLengkap.required' => 'Nama lengkap tidak boleh kosong.',
        'namaLengkap.string'   => 'Nama lengkap harus berupa teks.',
        'namaLengkap.max'      => 'Nama lengkap maksimal 255 karakter.',

        'email.required' => 'Email tidak boleh kosong.',
        'email.email'    => 'Format email tidak valid.',
        'email.unique'   => 'Email sudah terdaftar.',

        'nis.required' => 'NIS tidak boleh kosong.',
        'nis.unique'   => 'NIS sudah digunakan.',

        'gender.required' => 'Jenis kelamin wajib dipilih.',
        'status.required' => 'Status akun wajib dipilih.',

        'password.required' => 'Password wajib diisi.',
        'password.min'      => 'Password minimal 6 karakter.',
    ]);

    // ✅ Simpan data user ke database
    $user = User::create([
        'name'         => $request->namaLengkap,
        'email'        => $request->email,
        'NIS'          => $request->nis,
        'jenisKelamin' => $request->gender,
        'status'       => $request->status,
        'password'     => Hash::make($request->password),
    ]);

    return redirect()->back()->with('success', 'Data user berhasil ditambahkan!');
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


