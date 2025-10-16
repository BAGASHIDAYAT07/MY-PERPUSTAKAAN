<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjamans;
use App\Models\Buku;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;





class UserController extends Controller
{

    public function Buku()
{
    // 🔐 Pastikan user login
    if (!Auth::check()) {
        session(['redirect_after_login' => url()->current()]);
        return redirect('/login');
    }

    $ses = session()->all();
    if ($ses['role'] != 'user') {
        return redirect('/');
    }

    // 🔹 Ambil semua buku aktif
    $buku = Buku::where('status', 1)
        ->get()
        ->map(function ($item) {
            // 🔹 Cek apakah buku sedang dipinjam
            $pinjamAktif = DB::table('peminjaman')
                ->where('buku_id', $item->id)
                ->whereIn('status', ['menunggu', 'dipinjam'])
                ->exists();

            // Tambahkan status pinjam (buat tampilan)
            $item->peminjaman_status = $pinjamAktif ? 'dipinjam' : null;
            return $item;
        });

    // 🔹 Kirim ke view yang benar
    return view('admin.buku', [ // ⬅️ ubah ke folder view kamu
        "active" => "buku",
        "buku" => $buku
    ]);
}


    public function Favorit(){
        if (!Auth::check()) {
            session(['redirect_after_login' => url()->current()]);
            return redirect('/login');
        }
        return view("User.Favorit", ["active" => "Favorit"]);
    }
    
    // 🔹 Halaman history peminjaman
    public function History()
{
    if (!Auth::check()) {
        session(['redirect_after_login' => url()->current()]);
        return redirect('/login');
    }

    if (Auth::user()->role !== 'user') {
        return redirect('/');
    }

    $histories = Peminjamans::with(['buku'])
        ->where('user_id', Auth::id())
        ->where('status', 'dikembalikan')
        ->where('is_hidden', false) // 👈 hanya tampilkan yang belum disembunyikan
        ->orderBy('created_at', 'desc')
        ->paginate(5);

    return view('User.History', [
        'active' => 'History',
        'histories' => $histories
    ]);
}


    public function destroy($id)
{
    if (!Auth::check() || Auth::user()->role !== 'user') {
        return redirect('/');
    }

    // Cari data peminjaman milik user
    $pinjaman = Peminjamans::where('id', $id)
        ->where('user_id', Auth::id())
        ->first();

    if (!$pinjaman) {
        return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }

    // 🚫 Jangan hapus data, cukup sembunyikan dari tampilan user
    $pinjaman->is_hidden = true;
    $pinjaman->save();

    return redirect()->route('history.index')->with('success', 'Riwayat berhasil dihapus dari tampilan.');
}



}
