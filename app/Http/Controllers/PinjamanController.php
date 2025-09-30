<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Pinjaman::with(['user', 'buku'])->latest()->paginate(10);
        return view('user.peminjaman', compact('peminjamans'));
    }

    public function create()
    {
        $users = User::all();
        $bukus = Buku::all();
        return view('peminjaman.create', compact('users', 'bukus'));
    }

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

    public function edit(Pinjaman $pinjaman)
    {
        $users = User::all();
        $bukus = Buku::all();
        return view('peminjaman.update', compact('peminjaman', 'users', 'bukus'));
    }

    public function update(Request $request, Pinjaman $pinjaman)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:bukus,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date',
            'status' => 'required|in:dipinjam,dikembalikan',
        ]);

        $pinjaman->update($request->all());

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diperbarui');
    }

    public function destroy(Pinjaman $pinjaman)
    {
        $pinjaman->delete();
        return redirect()->route('pinjaman.index')->with('success', 'Peminjaman berhasil dihapus');
    }
}
