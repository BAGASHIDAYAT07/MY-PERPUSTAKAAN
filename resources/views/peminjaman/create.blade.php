@extends('template.appu')

@section("kontenU")
<div class="container">
    <h1>Tambah Peminjaman</h1>

    <form action="{{ route('User.Peminjaman') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="user_id" class="form-label">Peminjam</label>
            <select name="user_id" id="user_id" class="form-select" required>
                <option value="">-- Pilih User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="buku_id" class="form-label">Buku</label>
            <select name="buku_id" id="buku_id" class="form-select" required>
                <option value="">-- Pilih Buku --</option>
                @foreach($bukus as $buku)
                    <option value="{{ $buku->id }}">{{ $buku->judul }}</option>
                @endforeach
            </select>
            @error('buku_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" required>
            @error('tanggal_pinjam') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" required>
            @error('tanggal_kembali') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="">-- Pilih Status --</option>
                <option value="Dipinjam">Dipinjam</option>
                <option value="Kembali">Kembali</option>
            </select>
            @error('status') <div class="text-danger">{{ $message }}</div> @enderror
        </div> -->

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('User.Peminjaman') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
