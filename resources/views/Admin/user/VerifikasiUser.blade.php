@extends('template.app')

@section("konten")
<div class="container py-4" style="margin-top: -50px;">
  <!-- Judul Halaman -->
  <div class="card shadow-sm border-0 mb-4">
    <div class="card-body d-flex align-items-center">
      <i class="bi bi-people text-primary fs-1 me-3"></i>
      <div>
        <h3 class="fw-bold mb-0">Verifikasi User</h3>
        <small class="text-muted">Kelola verifikasi akun pengguna baru</small>
      </div>
    </div>
  </div>

  <!-- Header Aksi -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold text-secondary mb-0">Daftar Pengguna</h5>
  </div>

  <!-- Card Table -->
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <!-- Search -->
      <div class="mb-3">
        <input type="search" class="form-control form-control-sm" placeholder="Cari user...">
      </div>

      <!-- Table -->
      <div class="table-responsive">
        <table class="table table-striped table-hover align-middle mb-0 table-bordered border-secondary-subtle">
          <thead class="table-primary text-center">
            <tr>
              <th>Nama</th>
              <th>Email</th>
              <th>NIS</th>
              <th>Jenis Kelamin</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody class="text-center">

            <!-- User Belum Diverifikasi -->
            <tr>
              <td class="text-start">
                <img src="https://ui-avatars.com/api/?name=Enggal" class="rounded-circle me-2" width="32" height="32">
                Enggal
              </td>
              <td>enggal.@email.com</td>
              <td>USR002</td>
              <td>Laki-laki</td>
              <td>
                <span class="badge bg-warning text-dark">
                  <i class="bi bi-clock"></i> Menunggu
                </span>
              </td>
              <td>
                <div class="dropdown">
                  <button class="btn btn-sm btn-light border" data-bs-toggle="dropdown">
                    <i class="bi bi-three-dots-vertical"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <a class="dropdown-item text-success" href="#">
                        <i class="bi bi-check2-circle me-2"></i> Setujui
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item text-danger" href="#">
                        <i class="bi bi-x-circle me-2"></i> Tolak
                      </a>
                    </li>
                  </ul>
                </div>
              </td>
            </tr>

            <!-- User Ditolak -->
            <tr>
              <td class="text-start">
                <img src="https://ui-avatars.com/api/?name=Bagas" class="rounded-circle me-2" width="32" height="32">
                Bagas
              </td>
              <td>bagas.@email.com</td>
              <td>USR001</td>
              <td>Laki-laki</td>
              <td>
                <span class="badge bg-danger">
                  <i class="bi bi-x-circle"></i> Ditolak
                </span>
              </td>
              <td>
                <div class="dropdown">
                  <button class="btn btn-sm btn-light border" data-bs-toggle="dropdown" disabled>
                    <i class="bi bi-three-dots-vertical"></i>
                  </button>
                </div>
              </td>
            </tr>

            <!-- User Disetujui -->
            <tr>
              <td class="text-start">
                <img src="https://ui-avatars.com/api/?name=Anto" class="rounded-circle me-2" width="32" height="32">
                Anto
              </td>
              <td>anto.@email.com</td>
              <td>USR003</td>
              <td>Laki-laki</td>
              <td>
                <span class="badge bg-success">
                  <i class="bi bi-check2-circle"></i> Disetujui
                </span>
              </td>
              <td>
                <div class="dropdown">
                  <button class="btn btn-sm btn-light border" data-bs-toggle="dropdown" disabled>
                    <i class="bi bi-three-dots-vertical"></i>
                  </button>
                </div>
              </td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
