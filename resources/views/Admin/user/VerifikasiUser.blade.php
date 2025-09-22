@extends('template.app')

@section("konten")
<style>
  .status-badge {
    display: inline-block;
    font-size: 0.75rem;     /* ukuran teks kecil */
    padding: 0.25em 0.6em;  /* padding tipis */
    border-radius: 4px;     /* sudut agak kotak */
    font-weight: 500;       /* tebal sedang */
  }

  .status-menunggu { background-color: #ffc107; color: #212529; }
  .status-ditolak { background-color: #dc3545; color: #fff; }
  .status-disetujui { background-color: #198754; color: #fff; }

  /* Atur scroll tabel hanya untuk layar kecil */
  .table-wrapper {
    overflow-x: visible; /* default desktop: tidak scroll */
  }
  @media (max-width: 991.98px) {
    .table-wrapper {
      overflow-x: auto;   /* HP/tablet: aktifkan scroll kalau kepaksa */
    }
  }
</style>

<div class="container-fluid px-3" style="margin-top: -25px;">
  <!-- Judul Halaman -->
  <div class="d-flex align-items-center justify-content-between bg-white shadow-sm p-3 rounded mb-4">
    <div class="d-flex align-items-center">
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
      <div class="table-wrapper">
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
                <span class="status-badge status-menunggu">
                  <i class="bi bi-clock me-1"></i> Menunggu
                </span>
              </td>
              <td>
                <div class="dropdown">
                  <button class="btn btn-sm btn-light border" data-bs-toggle="dropdown">
                    <i class="bi bi-three-dots-vertical"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailUserModal">
                        <i class="bi bi-eye me-2"></i> Lihat Detail
                      </a>
                    </li>
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
                <span class="status-badge status-ditolak">
                  <i class="bi bi-x-circle me-1"></i> Ditolak
                </span>
              </td>
              <td>
                <div class="dropdown">
                  <button class="btn btn-sm btn-light border" data-bs-toggle="dropdown">
                    <i class="bi bi-three-dots-vertical"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailUserModal">
                        <i class="bi bi-eye me-2"></i> Lihat Detail
                      </a>
                    </li>
                  </ul>
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
                <span class="status-badge status-disetujui">
                  <i class="bi bi-check2-circle me-1"></i> Disetujui
                </span>
              </td>
              <td>
                <div class="dropdown">
                  <button class="btn btn-sm btn-light border" data-bs-toggle="dropdown">
                    <i class="bi bi-three-dots-vertical"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailUserModal">
                        <i class="bi bi-eye me-2"></i> Lihat Detail
                      </a>
                    </li>
                  </ul>
                </div>
              </td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Detail User -->
<div class="modal fade" id="detailUserModal" tabindex="-1">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-person-lines-fill me-2 text-primary"></i> Detail User
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-3">
          <img src="https://ui-avatars.com/api/?name=User+Demo" class="rounded-circle shadow" alt="Foto User" style="width: 100px; height: 100px;">
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><b>Nama:</b> Enggal</li>
          <li class="list-group-item"><b>Email:</b> enggal.@email.com</li>
          <li class="list-group-item"><b>NIS:</b> USR002</li>
          <li class="list-group-item"><b>Jenis Kelamin:</b> Laki-laki</li>
          <li class="list-group-item"><b>Status:</b> Menunggu</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
@endsection
