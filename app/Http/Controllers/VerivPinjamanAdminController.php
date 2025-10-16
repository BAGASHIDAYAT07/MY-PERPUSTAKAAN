<?php

namespace App\Http\Controllers;

use App\Models\Peminjamans;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class VerivPinjamanAdminController extends Controller
{
    /**
     * 🔹 Halaman verifikasi peminjaman (khusus admin)
     */
    public function veriv()
    {
        if (!Auth::check()) {
            session(['redirect_after_login' => url()->current()]);
            return redirect('/login');
        }

        $user = Auth::user();
        if ($user->role !== 'admin') {
            return redirect('/buku')->with('error', 'Akses ditolak.');
        }

        $peminjamans = Peminjamans::with(['user', 'buku'])
            ->latest()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('peminjaman.verivikasi', [
            "active" => "veriv",
            "peminjamans" => $peminjamans
        ]);
    }

    /**
     * 🔹 Setujui peminjaman
     */
    public function setujui($id)
    {
        $pinjam = Peminjamans::findOrFail($id);
        $user   = User::findOrFail($pinjam->user_id);

        if (empty($user->nomorwa)) {
            return back()->with('error', 'Nomor WhatsApp pengguna belum diisi.');
        }

        // Hitung tanggal batas pengembalian (7 hari dari sekarang)
        $tanggalPinjam = Carbon::now();
        $batasWaktu = $tanggalPinjam->copy()->addDays(7);

        // Format tanggal dalam bahasa Indonesia
        $hari = $batasWaktu->translatedFormat('l'); // contoh: Selasa
        $tanggalLengkap = $batasWaktu->translatedFormat('d F Y'); // contoh: 14 Oktober 2025

        // Update status di database
        $pinjam->update([
            'status' => 'dipinjam',
            'tanggal_pinjam' => $tanggalPinjam,
            'batas_waktu' => $batasWaktu
        ]);

        $pinjam->buku->update(['status_pinjam' => 'dipinjam']);

        // Pesan WhatsApp
        $pesan = "📚 *Peminjaman Diterima!*\n\n"
               . "Halo {$user->name}, peminjaman buku kamu telah *disetujui* ✅\n\n"
               . "📅 Tanggal Pinjam: " . $tanggalPinjam->translatedFormat('d F Y') . "\n"
               . "⏰ Batas Pengembalian: {$hari}, {$tanggalLengkap}\n\n"
               . "Mohon untuk mengembalikan buku tepat waktu ya. Terima kasih! 🙏";

        // Kirim pesan
        $hasil = $this->kirimPesanWA($user, $pesan);

        if (!$hasil['success']) {
            return back()->with('error', 'Disetujui, tapi gagal kirim WhatsApp.');
        }

        return back()->with('success', 'Peminjaman disetujui dan pesan WhatsApp dikirim.');
    }

    /**
     * 🔹 Tolak peminjaman
     */
    public function tolak($id)
    {
        $pinjam = Peminjamans::findOrFail($id);
        $user   = User::findOrFail($pinjam->user_id);

        $pinjam->update(['status' => 'ditolak']);
        $pinjam->buku->update(['status_pinjam' => 'tersedia']);

        $pesan = "❌ *Peminjaman Ditolak*\n\n"
               . "Maaf {$user->name}, pengajuan peminjaman buku kamu *ditolak*.\n"
               . "Terima kasih sudah mengajukan ya!";

        $this->kirimPesanWA($user, $pesan);

        return back()->with('success', 'Peminjaman ditolak dan notifikasi dikirim.');
    }

    /**
     * 🔹 Kembalikan buku
     */
    public function kembalikan($id)
    {
        $pinjam = Peminjamans::findOrFail($id);

        if ($pinjam->status !== 'dipinjam') {
            return back()->with('error', 'Buku ini belum dalam status dipinjam.');
        }

        $pinjam->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now()
        ]);
        $pinjam->buku->update(['status_pinjam' => 'tersedia']);

        $user = User::findOrFail($pinjam->user_id);

        $pesan = "📗 *Buku Telah Dikembalikan*\n\n"
               . "Terima kasih {$user->name}, buku yang kamu pinjam sudah dikembalikan. "
               . "Sampai jumpa di peminjaman berikutnya! 🙌";

        $this->kirimPesanWA($user, $pesan);

        return back()->with('success', 'Buku dikembalikan dan notifikasi dikirim.');
    }

    /**
     * 🔹 Kirim pesan WA (Fonnte API)
     */
    private function kirimPesanWA($user, $pesan)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => [
                'target' => "{$user->nomorwa}|{$user->name}",
                'message' => $pesan,
                'schedule' => 0,
                'typing' => false,
                'delay' => 2,
                'countryCode' => '62',
            ],
            CURLOPT_HTTPHEADER => [
                'Authorization: W7UwdDJWw5NzdcTsoeXC', // ganti token Fonnte kamu
            ],
        ]);

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            $error = curl_error($curl);
            curl_close($curl);
            return ['success' => false, 'message' => $error];
        }

        curl_close($curl);
        return ['success' => true, 'message' => $response];
    }

    /**
     * 🔹 Kirim pesan peringatan keterlambatan
     * (bisa dijalankan manual / lewat scheduler)
     */
    public function kirimPeringatanTerlambat()
    {
        $peminjamans = Peminjamans::with('user')
            ->where('status', 'dipinjam')
            ->whereDate('batas_waktu', '<', Carbon::now())
            ->get();

        foreach ($peminjamans as $pinjam) {
            $user = $pinjam->user;
            if (!$user || empty($user->nomorwa)) continue;

            $batas = Carbon::parse($pinjam->batas_waktu)->translatedFormat('d F Y');
            $pesan = "⚠️ *Peringatan Keterlambatan*\n\n"
                   . "Halo {$user->name}, buku yang kamu pinjam sudah *melewati batas waktu pengembalian*.\n"
                   . "Batas waktu: {$batas}\n\n"
                   . "Mohon segera dikembalikan ke perpustakaan ya 🙏";

            $this->kirimPesanWA($user, $pesan);
        }

        return back()->with('success', 'Pesan peringatan keterlambatan telah dikirim.');
    }
}
