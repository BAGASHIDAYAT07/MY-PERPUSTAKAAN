@extends('template.app')

@section("konten")

<h1 class="mt-4">Tambah Peminjaman Buku</h1>

<div class="card mb-4">
  <div class="card-header">
    <i class="fas fa-plus-circle me-1"></i>
    Form Peminjaman
  </div>
  <div class="card-body">
      @csrf
      <div class="mb-3">
        <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
        <input type="text" name="nama_peminjam" class="form-control" id="nama_peminjam" required>
      </div>

      <div class="mb-3">
        <label for="judul_buku" class="form-label">Judul Buku</label>
        <input type="text" name="judul_buku" class="form-control" id="judul_buku" required>
      </div>

      <div class="mb-3">
        <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
        <input type="date" name="tanggal_pinjam" class="form-control" id="tanggal_pinjam" required>
      </div>

      <div class="mb-3">
        <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
        <input type="date" name="tanggal_kembali" class="form-control" id="tanggal_kembali" required>
      </div>

      <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-control">
          <option value="dipinjam">Dipinjam</option>
          <option value="dikembalikan">Dikembalikan</option>
        </select>
      </div>
  </div>
</div>

@endsection
