@extends('template.appu')

@section("kontenU")
<div class="container">
    <h1>Tambah Peminjaman</h1>

    <form action="{{ route('peminjaman.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="user_id" class="form-label">Peminjam</label>
             <!-- <input list="users" name="user" id="user" class="form-control" placeholder="Ketik atau pilih user..." required> -->
            <select name="user_id" id="user_id" class="form-select" required>
                <option value="">-- Pilih User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="buku_id" class="form-label">Buku</label>
            <!-- <input list="bukuList" name="buku" id="buku" class="form-control" placeholder="Ketik atau pilih buku..." required> -->
            <select name="buku_id" id="buku_id" class="form-select" required>
                <option value="">-- Pilih Buku --</option>
                @foreach($bukus as $buku)
                    <option value="{{ $buku->id }}">{{ $buku->judul }}</option>
                @endforeach
            </select>
            @error('buku') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" required>
            @error('tanggal_pinjam') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('User.Peminjaman') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection