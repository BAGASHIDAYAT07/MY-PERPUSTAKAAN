@extends('template.app')

@section("konten")

<div class="container">
<h1 class="mt-4">Verifikasi Peminjaman Buku</h1>

<div class="card mb-4">
  <div class="card-header">
    <i class="fas fa-table me-1"></i> Daftar Peminjaman
  </div>
  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Nama Peminjam</th>
          <th>Judul Buku</th>
          <th>Tanggal Pinjam</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
        <tr>
            <td>bagas</td>
            <td>gatau</td>
            <td>12...</td>
            <td>gatau</td>
            <td>
                  <div class="dropdown" align="center">
                    <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item text-primary" href="#">Setujui</a></li>
                      <li><a class="dropdown-item text-danger" href="#">Tolak</a></li>
                    </ul>
                  </div>
                </td>
        </tr>
        <tr>
            <td>enggal</td>
            <td>gatau</td>
            <td>12...</td>
            <td>gatau</td>
            <td>
                  <div class="dropdown" align="center">
                    <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item text-primary" href="#">Setujui</a></li>
                      <li><a class="dropdown-item text-danger" href="#">Tolak</a></li>
                    </ul>
                  </div>
                </td>   
        </tr>
        <tr>
            <td>anto</td>
            <td>gatau</td>
            <td>12...</td>
            <td>gatau</td>
            <td>
                  <div class="dropdown" align="center">
                    <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item text-primary" href="#">Setujui</a></li>
                      <li><a class="dropdown-item text-danger" href="#">Tolak</a></li>
                    </ul>
                  </div>
                </td>
        </tr>
        <tr>
            <td>sugeng</td>
            <td>gatau</td>
            <td>12...</td>
            <td>gatau</td>
            <td>
                  <div class="dropdown" align="center">
                    <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item text-primary" href="#">Setujui</a></li>
                      <li><a class="dropdown-item text-danger" href="#">Tolak</a></li>
                    </ul>
                  </div>
                </td>
        </tr>
      </thead>
      </table>
  </div>
</div>
</div>
@endsection
