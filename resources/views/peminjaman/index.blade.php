@extends('template.app')

@section("konten")

  <div class="container">
    <h3 class="mb-4">Peminjaman</h3>

    <div class="card shadow-sm">
      <div class="card-body">
        <table class="table table-bordered align-middle">
          <thead class="table-dark">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama</th>
              <th scope="col">Email</th>
              <th scope="col">ID</th>
              <th scope="col">Jenis Kelamin</th>
              <th scope="col">Status</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Enggal Dwi</td>
              <td>enggal@example.com</td>
              <td>USR001</td>
              <td>Laki-laki</td>
              <td><span class="badge bg-success">Aktif</span></td>
              <td>
                <div class="dropdown">
                  <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    &#8942;
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item text-success" href="#">Aktifkan</a></li>
                    <li><a class="dropdown-item text-danger" href="#">Nonaktifkan</a></li>
                    <li><a class="dropdown-item text-primary" href="/pinjaman_update/1">Perbarui</a></li>
                  </ul>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>antooks</td>
              <td>antoks@example.com</td>
              <td>USR002</td>
              <td>Laki-laki</td>
              <td><span class="badge bg-danger">Tidak Aktif</span></td>
              <td>
                <div class="dropdown">
                  <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    &#8942;
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item text-success" href="#">Aktifkan</a></li>
                    <li><a class="dropdown-item text-danger" href="#">Nonaktifkan</a></li>
                    <li><a class="dropdown-item text-primary" href="/pinjaman_update/1">Perbarui</a></li>
                  </ul>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>bagasss</td>
              <td>bagas@example.com</td>
              <td>USR003</td>
              <td>Laki-laki</td>
              <td><span class="badge bg-success">Aktif</span></td>
              <td>
                <div class="dropdown">
                  <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    &#8942;
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item text-success" href="#">Aktifkan</a></li>
                    <li><a class="dropdown-item text-danger" href="#">Nonaktifkan</a></li>
                    <li><a class="dropdown-item text-primary" href="/pinjaman_update/1">Perbarui</a></li>
                  </ul>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
