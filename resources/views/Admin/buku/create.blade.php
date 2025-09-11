@extends('template.app')

@section("konten")

<div class="container">

<h1 class="mt-4">Tambah Buku</h1>

<div class="card mb-4">
  <div class="card-header">
    <i class="fas fa-plus-circle me-1"></i>
    Form Peminjaman
  </div>
  <div class="card-body">
      @csrf

      <div class="mb-3">
        <label for="judul_buku" class="form-label">Judul Buku</label>
        <input type="text" name="judul_buku" class="form-control" id="judul_buku" required>
      </div>

       <div class="mb-3">
        <label for="judul_buku" class="form-label">Jenis Buku</label>
        <input type="text" name="Jenis_buku" class="form-control" id="Jenis_buku" required>
      </div>

       <div class="mb-3">
        <label for="judul_buku" class="form-label">Penerbit</label>
        <input type="text" name="Penerbit" class="form-control" id="Penerbit" required>
      </div>

       <div class="mb-3">
        <label for="judul_buku" class="form-label">Pencipta</label>
        <input type="text" name="Pencipta" class="form-control" id="Pencipta" required>
      </div>

       <div class="mb-3">
        <label for="judul_buku" class="form-label">Tempat Terbit</label>
        <input type="text" name="Tempat_terbit" class="form-control" id="Tempat_terbit" required>
      </div>

      <div class="mb-3">
        <label for="tanggal_kembali" class="form-label">Tahun Terbit</label>
        <input type="date" name="tanggal_kembali" class="form-control" id="tanggal_kembali" required>
      </div>

       <div class="mb-3">
        <label for="judul_buku" class="form-label">Jumlah Halaman</label>
        <input type="text" name="Jumlah_halaman" class="form-control" id="Jumlah_halaman" required>
      </div>


      <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-control">
          <option value="dipinjam">Dipinjam</option>
          <option value="dikembalikan">Dikembalikan</option>
        </select>
        <a href="/pinjaman_create" class="btn btn-primary mt-3">Tambah Peminjaman</a>
      </div>
  </div>
</div>
</div>

@endsection
