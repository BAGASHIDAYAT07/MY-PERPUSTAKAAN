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
        $users = User::where('veriv', 0)
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('admin.user.VerifikasiUser', [
            "active" => "verifikasiuser",
            "users" => $users
        ]);
    }

    public function terima($id)
    {
        $user = User::findOrFail($id);

        // 🔹 Ubah jadi disetujui & aktif
        $user->veriv = 1;
        $user->status = 1; // pastikan ada kolom 'status' di tabel users
        $user->save();

        // ✅ Kirim pesan WhatsApp via Fonnte
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $user->nomorwa,
                'message' => "Selamat {$user->name}, akun Anda telah berhasil diverifikasi dan kini aktif! 🎉\n\nAnda sudah bisa login dan melakukan peminjaman buku di sistem perpustakaan kami.",
                'countryCode' => '62',
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: W7UwdDJWw5NzdcTsoeXC'
            ),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }

        curl_close($curl);

        if (isset($error_msg)) {
            return back()->with('error', 'Akun aktif, tapi gagal kirim pesan WhatsApp.');
        }

        return redirect()->back()->with('success', 'Akun berhasil disetujui, diaktifkan, dan notifikasi WhatsApp dikirim!');
    }

    public function tolak($id)
    {
        $user = User::findOrFail($id);

        // ❌ Kirim pesan WhatsApp sebelum dihapus
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $user->nomorwa,
                'message' => "Maaf {$user->name}, akun Anda tidak dapat diverifikasi. Silakan hubungi admin untuk informasi lebih lanjut.",
                'countryCode' => '62',
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: W7UwdDJWw5NzdcTsoeXC'
            ),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }

        curl_close($curl);

        // 🔥 Setelah kirim pesan baru hapus
        $user->delete();

        if (isset($error_msg)) {
            return back()->with('error', 'Akun dihapus, tapi gagal kirim pesan WhatsApp.');
        }

        return redirect()->back()->with('error', 'Akun telah ditolak dan pesan notifikasi dikirim.');
    }
}
