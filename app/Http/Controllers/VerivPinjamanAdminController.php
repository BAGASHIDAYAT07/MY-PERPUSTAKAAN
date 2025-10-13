<?php

namespace App\Http\Controllers;

use App\Models\Peminjamans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerivPinjamanAdminController extends Controller
{
    public function veriv()
    {
        // Pastikan login
        if (!Auth::check()) {
            session(['redirect_after_login' => url()->current()]);
            return redirect('/login');
        }

        // Hanya admin yang bisa masuk
        $user = Auth::user();
        if ($user->role !== 'admin') {
            return redirect('/buku')->with('error', 'Akses ditolak.');
        }

        // 🔹 Ambil semua data peminjaman + relasi buku & user
        $peminjamans = Peminjamans::with(['user', 'buku'])
            ->latest()
            ->paginate(10);

        return view('peminjaman.verivikasi', [
            "active" => "veriv",
            "peminjamans" => $peminjamans
        ]);
    }

    // 🔹 Fungsi untuk setujui pinjaman
    public function setujui($id)
{
    $pinjam = Peminjamans::findOrFail($id);

    // Ubah status jadi dipinjam dan isi tanggal_pinjam
    $pinjam->update([
        'status' => 'dipinjam',
        'tanggal_pinjam' => now() // otomatis tanggal hari ini
    ]);

    // Update status buku juga
    $pinjam->buku->update(['status_pinjam' => 'dipinjam']);

    return back()->with('success', 'Peminjaman telah disetujui.');
}


    // 🔹 Fungsi untuk tolak pinjaman
    public function tolak($id)
    {
        $pinjam = Peminjamans::findOrFail($id);
        $pinjam->update(['status' => 'ditolak']);

        // Pastikan buku tersedia lagi
        $pinjam->buku->update(['status_pinjam' => 'tersedia']);

        return back()->with('success', 'Peminjaman telah ditolak.');
    }

    // 🔹 Fungsi untuk pengembalian buku
public function kembalikan($id)
{
    $pinjam = Peminjamans::findOrFail($id);

    // Pastikan status sebelumnya adalah "dipinjam"
    if ($pinjam->status !== 'dipinjam') {
        return back()->with('error', 'Buku ini belum dalam status dipinjam.');
    }

    // Update status peminjaman dan buku
    $pinjam->update([
        'status' => 'dikembalikan',
        'tanggal_kembali' => now() // otomatis isi tanggal hari ini
    ]);

    $pinjam->buku->update(['status_pinjam' => 'tersedia']);

    return back()->with('success', 'Buku telah dikembalikan dan tanggal pengembalian tercatat.');
}


}
