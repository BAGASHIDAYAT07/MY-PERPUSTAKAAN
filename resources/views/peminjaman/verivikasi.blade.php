@extends('template.app')

@section("konten")
<style>
  .status-badge {
    display: inline-block;
    font-size: 0.75rem;     /* lebih kecil */
    padding: 0.25em 0.6em;  /* padding tipis */
    border-radius: 4px;     /* sudut agak kotak */
    font-weight: 500;       /* teks sedang */
  }

  .status-menunggu {
    background-color: #ffc107; /* kuning */
    color: #212529;
  }

  .status-ditolak {
    background-color: #dc3545; /* merah */
    color: #fff;
  }

  .status-disetujui {
    background-color: #198754; /* hijau */
    color: #fff;
  }
</style>

<div class="container-fluid px-3" style="margin-top: -25px;">
  <!-- Judul Halaman -->
  <div class="d-flex align-items-center justify-content-between bg-white shadow-sm p-3 rounded mb-4">
    <div class="d-flex align-items-center">
      <i class="bi bi-journal-check text-primary fs-1 me-3"></i>
      <div>
        <h3 class="fw-bold mb-0">Verifikasi Peminjaman</h3>
        <small class="text-muted">Kelola verifikasi pinjaman buku</small>
      </div>
    </div>
  </div>

  <!-- Header Aksi -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold text-secondary mb-0">Daftar Peminjaman</h5>
  </div>

  <!-- Card Table -->
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <!-- Search -->
      <div class="mb-3">
        <input type="search" class="form-control form-control-sm" placeholder="Cari peminjam...">
      </div>

      <!-- Table -->
      <div class="table-responsive">
        <table class="table table-striped table-hover align-middle mb-0 table-bordered border-secondary-subtle">
          <thead class="table-primary text-center">
            <tr>
              <th>Nama Peminjam</th>
              <th>Judul Buku</th>
              <th>Email</th>
              <th>Tanggal Pinjam</th>
              <th>Tanggal Kembali</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody class="text-center">

            <!-- User Ditolak -->
            <tr>
              <td class="text-start">
                <img src="https://ui-avatars.com/api/?name=Bagas" class="rounded-circle me-2" width="32" height="32">
                Bagas
              </td>
              <td>PsikopatNew</td>
              <td>bagas.@email.com</td>
              <td>15 Januari 2024</td>
              <td>15 Januari 2024</td>
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
                      <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailBukuModal">
                        <i class="bi bi-eye me-2"></i> Lihat Detail
                      </a>
                    </li>
                  </ul>
                </div>
              </td>
            </tr>

            <!-- User Menunggu -->
            <tr>
              <td class="text-start">
                <img src="https://ui-avatars.com/api/?name=Enggal" class="rounded-circle me-2" width="32" height="32">
                Enggal
              </td>
              <td>PsikopatNew</td>
              <td>enggal.@email.com</td>
              <td>14 Januari 2024</td>
              <td>15 Januari 2024</td>
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

            <!-- User Disetujui -->
            <tr>
              <td class="text-start">
                <img src="https://ui-avatars.com/api/?name=Anto" class="rounded-circle me-2" width="32" height="32">
                Anto
              </td>
              <td>PsikopatNew</td>
              <td>anto.@email.com</td>
              <td>13 Januari 2024</td>
              <td>15 Januari 2024</td>
              <td>
                <span class="status-badge status-disetujui">
                  <i class="bi bi-check2-circle me-1"></i> Disetujui
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

<!-- Modal Detail Buku -->
<div class="modal fade" id="detailBukuModal" tabindex="-1">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-journal-text me-2 text-primary"></i> Detail Buku
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-3">
          <img src="../img/photos/buku1.jpeg" class="rounded shadow" alt="Foto Buku" style="width: 150px;">
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><b>Nama Peminjam:</b> Sugeng Riadi</li>
          <li class="list-group-item"><b>Judul Buku:</b> Tutor Sugieh</li>
          <li class="list-group-item"><b>Jenis Buku:</b> Mbuh</li>
          <li class="list-group-item"><b>Tanggal Pinjam:</b> 15 April 2025</li>
          <li class="list-group-item"><b>Tanggal Kembali:</b> 17 April 2025</li>
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
