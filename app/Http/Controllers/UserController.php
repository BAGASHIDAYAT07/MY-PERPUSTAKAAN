<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjamans;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;





class UserController extends Controller
{

    public function Buku(){
        $buku = Buku::where('status', 1)->get();
            if (!Auth::check()) {
            session(['redirect_after_login' => url()->current()]);
            return redirect('/login');
        }
        $ses = session()->all();
        if($ses['role'] != 'user'){
            return redirect('/');
        } 
        return view('admin.buku', ["active" => "buku", 'buku' => $buku]);

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

        // Ambil semua data peminjaman milik user yang sedang login
        $histories = Peminjamans::with(['buku'])
            ->where('user_id', Auth::id())
            ->where('status', 'dikembalikan')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('User.History', [
            'active' => 'History',
            'histories' => $histories
        ]);
    }

    public function destroy($id)
{
    // 🔒 Pastikan user login dan rolenya 'user'
    if (!Auth::check() || Auth::user()->role !== 'user') {
        return redirect('/');
    }

    // 🔍 Cari data peminjaman berdasarkan ID dan user yang sedang login
    $pinjaman = Peminjamans::where('id', $id)
        ->where('user_id', Auth::id())
        ->first();

    // ⚠️ Kalau tidak ditemukan
    if (!$pinjaman) {
        return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }

    // 🗑️ Hapus data
    $pinjaman->delete();

    // ✅ Redirect kembali ke halaman history
    return redirect()->route('history.index')->with('success', 'Riwayat berhasil dihapus.');
}


}
