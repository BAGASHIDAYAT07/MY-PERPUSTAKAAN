<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BukuController extends Controller
{

public function tambahbuku(Request $request)
{
    $request->validate([
        'judul' => [
            'required',
            'string',
            'max:255',
            Rule::unique('bukus')->where(function ($query) use ($request) {
                return $query->where('JenisBuku', $request->JenisBuku)
                             ->where('Penerbit', $request->Penerbit)
                             ->where('Pencipta', $request->Pencipta)
                             ->where('TahunTerbit', $request->TahunTerbit)
                             ->where('namarak', $request->namarak)
                             ->where('norak', $request->norak);
            }),
        ],
        'deskripsi' => 'required|string|max:255',
        'JenisBuku' => 'required|string|max:255',
        'Penerbit' => 'required|string|max:255',
        'Pencipta' => 'required|string|max:255',
        'TempatTerbit' => 'required|string|max:255',
        'TahunTerbit' => 'required|integer',
        'JumlahHalaman' => 'required|integer',
        'namarak' => 'required|string|max:255',
        'norak' => 'required|string|max:255',
        'status' => 'required|boolean',
        'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ], [
    'deskripsi.required'     => 'Deskripsi buku tidak boleh kosong.',
    'deskripsi.string'       => 'Deskripsi buku harus berupa teks.',
    'deskripsi.max'          => 'Deskripsi buku maksimal 255 karakter.',

    'JenisBuku.required'     => 'Jenis buku wajib diisi.',
    'JenisBuku.string'       => 'Jenis buku harus berupa teks.',
    'JenisBuku.max'          => 'Jenis buku maksimal 255 karakter.',

    'Penerbit.required'      => 'Nama penerbit wajib diisi.',
    'Penerbit.string'        => 'Nama penerbit harus berupa teks.',
    'Penerbit.max'           => 'Nama penerbit maksimal 255 karakter.',

    'Pencipta.required'      => 'Nama pencipta wajib diisi.',
    'Pencipta.string'        => 'Nama pencipta harus berupa teks.',
    'Pencipta.max'           => 'Nama pencipta maksimal 255 karakter.',

    'TempatTerbit.required'  => 'Tempat terbit wajib diisi.',
    'TempatTerbit.string'    => 'Tempat terbit harus berupa teks.',
    'TempatTerbit.max'       => 'Tempat terbit maksimal 255 karakter.',

    'TahunTerbit.required'   => 'Tahun terbit wajib diisi.',
    'TahunTerbit.integer'    => 'Tahun terbit harus berupa angka.',

    'JumlahHalaman.required' => 'Jumlah halaman wajib diisi.',
    'JumlahHalaman.integer'  => 'Jumlah halaman harus berupa angka.',

    'namarak.required'       => 'Nama rak wajib diisi.',
    'namarak.string'         => 'Nama rak harus berupa teks.',
    'namarak.max'            => 'Nama rak maksimal 255 karakter.',

    'norak.required'         => 'Nomor rak wajib diisi.',
    'norak.string'           => 'Nomor rak harus berupa teks.',
    'norak.max'              => 'Nomor rak maksimal 255 karakter.',

    'status.required'        => 'Status buku wajib dipilih.',
    'status.boolean'         => 'Status buku harus berupa pilihan aktif atau nonaktif.',

    'foto.required'          => 'Foto buku wajib diunggah.',
    'foto.image'             => 'File yang diunggah harus berupa gambar.',
    'foto.mimes'             => 'Format foto harus JPG, JPEG, atau PNG.',
    'foto.max'               => 'Ukuran foto maksimal 2MB.',
]);

    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('uploads', $fileName, 'public');
    }

    Buku::create([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'JenisBuku' => $request->JenisBuku,
        'Penerbit' => $request->Penerbit,
        'Pencipta' => $request->Pencipta,
        'TempatTerbit' => $request->TempatTerbit,
        'TahunTerbit' => $request->TahunTerbit,
        'JumlahHalaman' => $request->JumlahHalaman,
        'namarak' => $request->namarak,
        'norak' => $request->norak,
        'status' => $request->status,
        'foto' => $path,
    ]);

    return redirect()->route('rakbuku')->with('success', 'Buku berhasil ditambahkan!');
}


// RAK BUKU
public function RakBuku()
{
            if (!Auth::check()) {
            session(['redirect_after_login' => url()->current()]);
            return redirect('/login');
        }
        $ses = session()->all();
        if($ses['role'] != 'admin'){
            return redirect('/buku');
        }
    // Ambil semua data buku dari database
    $buku = Buku::paginate(10);


       // Kirim ke view
    return view('admin.RakBuku.RakBuku', [
        "active" => "rakbuku",
        "buku"   => $buku,
    ]);
}

public function update(Request $request, $id)
{
    $buku = Buku::findOrFail($id);

    $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'JenisBuku' => 'required|string',
        'Penerbit' => 'nullable|string',
        'Pencipta' => 'nullable|string',
        'TempatTerbit' => 'nullable|string',
        'TahunTerbit' => 'nullable|numeric',
        'JumlahHalaman' => 'nullable|numeric',
        'namarak' => 'nullable|string',
        'norak' => 'nullable|string',
        'status' => 'required|boolean',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // ✅ Jika ada foto baru diupload, simpan ke lokal storage
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('uploads', $fileName, 'public');

        // Hapus foto lama kalau ada dan masih di storage lokal
        if ($buku->foto && file_exists(storage_path('app/public/' . $buku->foto))) {
            unlink(storage_path('app/public/' . $buku->foto));
        }

        $buku->foto = $path; // simpan path baru
    }

    // ✅ Update data lain (selain foto)
    $buku->update($request->except('foto'));

    // ✅ Simpan perubahan foto (kalau ada)
    $buku->save();

    return redirect()->back()->with('success', 'Data buku berhasil diperbarui!');
}


public function toggleStatus($id)
{
    $buku = Buku::findOrFail($id);

    // 🔹 Cek apakah buku sedang dipinjam
    if ($buku->status_pinjam === 'dipinjam' && $buku->status == 1) {
        return redirect()->back()->with('error', 'Tidak dapat merubah status karena buku sedang dipinjam.');
    }

    // 🔹 Toggle status (0 -> 1 atau 1 -> 0)
    $buku->status = !$buku->status;
    $buku->save();

    return redirect()->back()->with('success', 'Status buku berhasil diubah!');
}


}
