<?php

namespace App\Http\Controllers;

use App\Models\Peminjamans;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PinjamanController extends Controller
{
    // 🔹 Halaman daftar peminjaman (khusus user login)
    public function pinjamanUser()
    {
        if (!Auth::check()) {
            session(['redirect_after_login' => url()->current()]);
            return redirect('/login');
        }

        $peminjamans = Peminjamans::with(['user', 'buku'])
            ->where('user_id', Auth::id())
            ->whereIn('status', ['menunggu', 'dipinjam', 'ditolak'])
            ->latest()
            ->paginate(10);

        return view("User.Peminjaman", [
            "active" => "Peminjaman",
            "peminjamans" => $peminjamans,
        ]);
    }

    // 🔹 Form tambah peminjaman (khusus admin)
    public function create()
    {
        $users = User::all();
        $bukus = Buku::all();

        return view('peminjaman.create', [
            "active" => "rakbuku",
            "users" => $users,
            "bukus" => $bukus,
        ]);
    }

    // 🔹 Simpan data baru peminjaman (admin)
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:bukus,id',
            'tanggal_pinjam' => 'nullable|date',
            'tanggal_kembali' => 'nullable|date',
        ]);

        // Admin bisa langsung set status dipinjam
        $peminjaman = Peminjamans::create([
            'user_id' => $request->user_id,
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => $request->tanggal_pinjam ?? now(),
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'dipinjam',
        ]);

        // Update status buku jadi "dipinjam"
        Buku::where('id', $request->buku_id)->update(['status_pinjam' => 'dipinjam']);

        return redirect()->route('User.Peminjaman')
            ->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    // 🔹 Form edit peminjaman (admin)
    public function edit(Peminjamans $peminjaman)
    {
        $users = User::all();
        $bukus = Buku::all();

        return view('peminjaman.update', [
            "active" => "rakbuku",
            "peminjaman" => $peminjaman,
            "users" => $users,
            "bukus" => $bukus,
        ]);
    }

    // 🔹 Update data peminjaman (admin)
    public function update(Request $request, Peminjamans $peminjaman)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:bukus,id',
            'tanggal_pinjam' => 'nullable|date',
            'tanggal_kembali' => 'nullable|date',
            'status' => 'required|in:menunggu,dipinjam,dikembalikan',
        ]);

        $data = $request->all();

        // 🟢 Jika admin menyetujui (ubah status ke dipinjam) dan tanggal_pinjam masih kosong
        if ($request->status === 'dipinjam' && !$peminjaman->tanggal_pinjam) {
            $data['tanggal_pinjam'] = now();
        }


        $peminjaman->update($data);

        // 🔸 Ubah status buku sesuai status peminjaman
        $buku = Buku::find($peminjaman->buku_id);
        if ($buku) {
            if ($request->status === 'dipinjam') {
                $buku->update(['status_pinjam' => 'dipinjam']);
            } elseif ($request->status === 'dikembalikan') {
                $buku->update(['status_pinjam' => 'tersedia']);
            } elseif ($request->status === 'menunggu') {
                $buku->update(['status_pinjam' => 'tersedia']);
            }
        }

        return redirect()->route('User.Peminjaman')
            ->with('success', 'Peminjaman berhasil diperbarui.');
    }

    // 🔹 Hapus data peminjaman
    public function destroy(Peminjamans $peminjaman)
{
    // 🔹 Cek status peminjaman
    if ($peminjaman->status === 'dipinjam') {
        return redirect()->route('User.Peminjaman')
            ->with('error', 'Peminjaman yang sudah disetujui tidak bisa dihapus.');
    }

    $buku = Buku::find($peminjaman->buku_id);
    if ($buku) {
        $buku->update(['status_pinjam' => 'tersedia']);
    }

    $peminjaman->delete();

    return redirect()->route('User.Peminjaman')
        ->with('success', 'Peminjaman berhasil dihapus dan status buku dikembalikan.');
}


    // 🔹 Aksi pinjam buku langsung (user login)
    public function pinjam(Request $request, $id_buku)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();

        // 🔸 Cegah pinjam buku yang masih menunggu atau dipinjam
        $cek = Peminjamans::where('buku_id', $id_buku)
            ->whereIn('status', ['menunggu', 'dipinjam'])
            ->exists();

        if ($cek) {
            return back()->with('error', 'Buku ini sedang dipinjam atau menunggu persetujuan admin.');
        }

        // 🔸 Simpan data peminjaman baru (tanpa tanggal_pinjam)
        Peminjamans::create([
            'user_id' => $user->id,
            'buku_id' => $id_buku,
            'tanggal_pinjam' => null,
            'status' => 'menunggu', // 🟡 Status awal
        ]);

        return redirect('/pinjaman')->with('success', 'Permintaan peminjaman dikirim. Menunggu verifikasi admin.');
    }
}
