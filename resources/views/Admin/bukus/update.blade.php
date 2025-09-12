@extends('template.app')

@section("konten")
<div class="container">
<h1 class="mt-4">Ubah Buku</h1>

<div class="card mb-4">
  <div class="card-header">
    <i class="fas fa-edit me-1"></i>
   Formulir Ubah Buku
  </div>
  <div class="card-body">
    <form method="POST">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label for="judul_buku" class="form-label">Judul Buku</label>
        <input type="text" name="judul_buku" class="form-control" id="judul_buku" 
               value="" required>
      </div>

      <div class="mb-3">
        <label for="jenis_buku" class="form-label">Jenis Buku</label>
        <input type="text" name="jenis_buku" class="form-control" id="jenis_buku" 
               value="" required>
      </div>

       <div class="mb-3">
        <label for="nama_penerbit" class="form-label">Nama Penerbit</label>
        <input type="text" name="nama_penerbit" class="form-control" id="nama_penerbit" 
               value="" required>
      </div>

       <div class="mb-3">
        <label for="nama_pencipta" class="form-label">Nama Pencipta</label>
        <input type="text" name="nama_pencipta" class="form-control" id="nama_pencipta" 
               value="" required>
      </div>

       <div class="mb-3">
        <label for="tempat_terbit" class="form-label">Tempat Terbit</label>
        <input type="text" name="tempat_terbit" class="form-control" id="tempat_terbit" 
               value="" required>
      </div>

      <div class="mb-3">
        <label for="tanggal_terbit" class="form-label">Tanggal Terbit</label>
        <input type="date" name="tanggal_terbit" class="form-control" id="tanggal_terbit" 
               value="" required>
      </div>

      <div class="mb-3">
        <label for="jumlah_halaman" class="form-label">Jumlah Halaman</label>
        <input type="text" name="jumlah_halaman" class="form-control" id="jumlah_halaman" 
               value="" required>
      </div>

      <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-control">

        </select>
      </div>

      <a href="/createbuk" class="btn btn-success">Ubah</a>
    </form>
  </div>
</div>
</div>

@endsection
