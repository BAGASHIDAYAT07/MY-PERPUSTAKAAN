@extends('template.app')

@section("konten")

<h1 class="mt-4">Edit Peminjaman</h1>

<div class="card mb-4">
  <div class="card-header">
    <i class="fas fa-edit me-1"></i>
    Form Edit Peminjaman
  </div>
  <div class="card-body">
     <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
    @csrf
    @method('PUT')

      <div class="mb-3">
        <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
        <input type="text" name="nama_peminjam" class="form-control">
      </div>

      <div class="mb-3">
        <label for="judul_buku" class="form-label">Judul Buku</label>
        <input type="text" name="judul_buku" class="form-control" 
               value="{{ $peminjaman->judul_buku }}" required>
      </div>

      <div class="mb-3">
        <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
        <input type="date" name="tanggal_pinjam" class="form-control" 
               value="{{ $peminjaman->tanggal_pinjam }}" required>
      </div>

      <div class="mb-3">
        <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
        <input type="date" name="tanggal_kembali" class="form-control" 
               value="{{ $peminjaman->tanggal_kembali }}" required>
      </div>

      <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" class="form-control">
          <option value="dipinjam" {{ $peminjaman->status == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
          <option value="dikembalikan" {{ $peminjaman->status == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
        </select>
      </div>

      <button type="submit" class="btn btn-success">Update</button>
  </div>
</div>

@endsection
