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
        'judul.unique' => 'Kombinasi data buku (judul, jenis buku, penerbit, pencipta, tahun terbit, rak) sudah ada.',
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
    $buku = Buku::all();


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

    // Jika ada upload foto baru → upload ke Supabase
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $response = Http::withHeaders([
            'apikey' => config('services.supabase.key'),
            'Authorization' => 'Bearer ' . config('services.supabase.key'),
        ])->attach(
            'file',
            file_get_contents($file),
            $fileName
        )->post(
            config('services.supabase.url') . "/storage/v1/object/" 
            . config('services.supabase.bucket') 
            . "/" . $fileName . "?upsert=true"
        );

        if ($response->successful()) {
            $buku->foto = config('services.supabase.url') . "/storage/v1/object/public/"
                . config('services.supabase.bucket') . "/" . $fileName;
        } else {
            return back()->withErrors(['foto' => 'Upload gagal: ' . $response->body()]);
        }
    }

    // Update data lain
    $buku->update($request->except('foto'));

    return redirect()->back()->with('success', 'Data buku berhasil diperbarui!');
}

public function toggleStatus($id)
{
    $buku = Buku::findOrFail($id);

    // Toggle status (0 -> 1 / 1 -> 0)
    $buku->status = !$buku->status;
    $buku->save();

    return redirect()->back()->with('success', 'Status buku berhasil diubah!');
}

}
