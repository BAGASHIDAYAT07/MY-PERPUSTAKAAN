<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class VerivUserAdminController extends Controller
{
    public function index()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            session(['redirect_after_login' => url()->current()]);
            return redirect('/login');
        }

        // Cek role admin
        $ses = session()->all();
        if ($ses['role'] != 'admin') {
            return redirect('/buku');
        }

        // 🔥 Ambil hanya user yang BELUM diverifikasi
        $users = User::where('veriv', 0)->paginate(10);

        return view('admin.user.VerifikasiUser', [
            "active" => "verifikasiuser",
            "users" => $users
        ]);
        }
        public function terima($id)
        {
            $user = User::findOrFail($id);
            $user->veriv = 1; // ubah jadi disetujui
            $user->save();

            return redirect()->back()->with('success', 'Akun berhasil disetujui!');
        }

        public function tolak($id)
        {
            $user = User::findOrFail($id);
            $user->delete(); // atau bisa juga ubah status jika kamu tidak mau hapus

            return redirect()->back()->with('error', 'Akun telah ditolak dan dihapus.');
        }

}
