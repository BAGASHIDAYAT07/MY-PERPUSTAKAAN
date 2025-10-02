<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PinjamanController extends Controller
{
    // Halaman daftar peminjaman
    public function pinjamanUser()
    {
                if (!Auth::check()) {
            session(['redirect_after_login' => url()->current()]);
            return redirect('/login');
        }
        $peminjamans = Pinjaman::with(['user', 'buku'])->latest()->paginate(10);
        return view("User.Peminjaman", [
            "active" => "Peminjaman",
            "peminjamans" => $peminjamans
        ]);
    }

    // Form tambah peminjaman
    public function create()
    {
        $users = User::all();
        $bukus = Buku::all();
        return view('peminjaman.create', [
        "active" => "rakbuku",
        "users" => $users,
        "bukus" => $bukus
    ]);
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:bukus,id',
            'tanggal_pinjam' => 'required|date',
        ]);

        Pinjaman::create($request->all());

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil ditambahkan');
    }

    // Form edit peminjaman
    public function edit(Pinjaman $peminjaman)
    {
        $users = User::all();
        $bukus = Buku::all();
        return view('peminjaman.update', [
        "active" => "rakbuku",
        
    ]);
    }

    // Update data peminjaman
    public function update(Request $request, Pinjaman $peminjaman)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:bukus,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date',
            'status' => 'required|in:dipinjam,dikembalikan',
        ]);

        $peminjaman->update($request->all());

        return redirect()->route('User.Peminjaman')->with('success', 'Peminjaman berhasil diperbarui');
    }

    // Hapus data peminjaman
    public function destroy(Pinjaman $peminjaman)
    {
        $peminjaman->delete();
        return redirect()->route('User.Peminjaman')->with('success', 'Peminjaman berhasil dihapus');
    }
}
