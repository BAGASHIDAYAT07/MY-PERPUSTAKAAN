@extends('template.app')

@section("konten")
<div class="container">
    <h1>Edit Peminjaman</h1>

    <form action="{{ route('peminjaman.update', $peminjaman) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="user_id" class="form-label">Peminjam</label>
            <select name="user_id" id="user_id" class="form-select" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $peminjaman->user_id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @error('user_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="buku_id" class="form-label">Buku</label>
            <select name="buku_id" id="buku_id" class="form-select" required>
                @foreach($bukus as $buku)
                    <option value="{{ $buku->id }}" {{ $buku->id == $peminjaman->buku_id ? 'selected' : '' }}>
                        {{ $buku->judul }}
                    </option>
                @endforeach
            </select>
            @error('buku_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam"
                   value="{{ $peminjaman->tanggal_pinjam }}" class="form-control" required>
            @error('tanggal_pinjam') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" id="tanggal_kembali"
                   value="{{ $peminjaman->tanggal_kembali }}" class="form-control">
            @error('tanggal_kembali') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="dipinjam" {{ $peminjaman->status == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                <option value="dikembalikan" {{ $peminjaman->status == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
            </select>
            @error('status') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('User.Peminjaman') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
