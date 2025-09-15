@extends('template.app')

@section("konten")
<div class="container">
<h1 class="mt-4">Pembaruan Peminjaman Buku</h1>

<div class="card mb-4">
  <div class="card-header">
    <i class="fas fa-edit me-1"></i>
    Formulir pembaruan Peminjaman
  </div>
  <div class="card-body">
    <form method="POST">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
        <input type="text" name="nama_peminjam" class="form-control" id="nama_peminjam" 
               value="" required>
      </div>

      <div class="mb-3">
        <label for="judul_buku" class="form-label">Judul Buku</label>
        <input type="text" name="judul_buku" class="form-control" id="judul_buku" 
               value="" required>
      </div>

      <div class="mb-3">
        <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
        <input type="date" name="tanggal_pinjam" class="form-control" id="tanggal_pinjam" 
               value="" required>
      </div>

      <div class="mb-3">
        <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
        <input type="date" name="tanggal_kembali" class="form-control" id="tanggal_kembali" 
               value="" required>
      </div>

      <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-control">

        </select>
      </div>

      <button type="submit" class="btn btn-success">Perbarui</button>
      <a href="" class="btn btn-secondary">Batal</a>
      <a href="/pinjaman_create" class="btn btn-primary mb-3 mt-3">Tambah Peminjaman</a>
    </form>
  </div>
</div>
</div>

@endsection
