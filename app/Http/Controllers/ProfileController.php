<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->back()->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Validasi
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload foto ke Supabase
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = "users/{$user->id}/" . time() . "." . $file->extension();

            $url = $this->uploadToSupabase($file, $filename);

            $user->foto = $url;
        }

        // Update data user
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    private function uploadToSupabase($file, $filename)
    {
        $url = env('SUPABASE_URL') . "/storage/v1/object/" . env('SUPABASE_BUCKET') . "/$filename";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('SUPABASE_KEY'),
            'apikey' => env('SUPABASE_KEY'),
        ])->attach(
            'file', file_get_contents($file), $filename
        )->post($url);

        if ($response->failed()) {
            throw new \Exception("Upload gagal: " . $response->body());
        }

        // URL publik
        return env('SUPABASE_URL') . "/storage/v1/object/public/" . env('SUPABASE_BUCKET') . "/$filename";
    }
}
