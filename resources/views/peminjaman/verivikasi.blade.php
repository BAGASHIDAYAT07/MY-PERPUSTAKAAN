@extends('template.app')

@section("konten")

<div class="container mt-4">
  <h3 class="fw-bold">Daftar Verifikasi</h3>
  <p class="text-muted">Kelola Verifikasi Pinjaman</p>

  <div class="card shadow-sm">
    <div class="card-body p-0">
      <table class="table align-middle mb-0">
        <thead class="table-light">
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
        <tbody>

          <!-- User 1 -->
          <tr>
            <td>
              <div class="d-flex align-items-center">
                <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center" 
                     style="width: 40px; height: 40px;">
                  BP
                </div>
                <div class="ms-3">
                  <div class="fw-bold">Bagas</div>
                </div>
              </div>
            </td>
            <td>
              <div class="fw-bold">PsikopatNew</div>
            </td>
            <td>
              <i class="bi bi-envelope me-1"></i> bagas.@email.com
            </td>
            <td>
              <i class="bi bi-calendar me-1"></i> 15 Januari 2024
            </td>
            <td>
              <i class="bi bi-calendar me-1"></i> 15 Januari 2024
            </td>
            <td>
              <span class="badge bg-danger">
                <i class="bi bi-check2-circle me-1"></i> Ditolak
              </span>
            </td>
            <td>
              <div class="dropdown" align="center">
                <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailBukuModal">
                      <i class="bi bi-eye me-2"></i> Lihat Detail
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <i class="bi bi-check-circle me-2"></i> Setujui
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editBukuModal">
                      <i class="bi bi-x-circle me-2"></i> Tolak
                    </a>
                  </li>
                </ul>
              </div>
            </td>
          </tr>

          <!-- User 2 -->
          <tr>
            <td>
              <div class="d-flex align-items-center">
                <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center" 
                     style="width: 40px; height: 40px;">
                  ES
                </div>
                <div class="ms-3">
                  <div class="fw-bold">Enggal</div>
                </div>
              </div>
            </td>
            <td>
              <div class="fw-bold">PsikopatNew</div>
            </td>
            <td>
              <i class="bi bi-envelope me-1"></i> enggal.@email.com
            </td>
            <td>
              <i class="bi bi-calendar me-1"></i> 14 Januari 2024
            </td>
            <td>
              <i class="bi bi-calendar me-1"></i> 15 Januari 2024
            </td>
            <td>
              <span class="badge bg-light text-dark border">
                <i class="bi bi-clock me-1"></i> Menunggu Verifikasi
              </span>
            </td>

            <!-- button -->
            <td>
              <div class="dropdown" align="center">
                <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailBukuModal">
                      <i class="bi bi-eye me-2"></i> Lihat Detail
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <i class="bi bi-check-circle me-2"></i> Setujui
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editBukuModal">
                      <i class="bi bi-x-circle me-2"></i> Tolak
                    </a>
                  </li>
                </ul>
              </div>
            </td>
          </tr>

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
                    <li class="list-group-item"><b>Nama Peminjam</b>Sugeng Riadi</li>
                    <li class="list-group-item"><b>Judul Buku:</b>Tutor Sugieh</li>
                    <li class="list-group-item"><b>Jenis Buku:</b>Mbuh</li>
                    <li class="list-group-item"><b>Tanggal Pinjam:</b>15 April 2025</li>
                    <li class="list-group-item"><b>Tanggal Kembali:</b>17 April 2025</li>
                    <li class="list-group-item"><b>Status:</b></li>
                  </ul>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal Edit Buku -->
         
          <!-- User 3 -->
          <tr>
            <td>
              <div class="d-flex align-items-center">
                <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center" 
                     style="width: 40px; height: 40px;">
                  AW
                </div>
                <div class="ms-3">
                  <div class="fw-bold">Anto</div>
                </div>
              </div>
            </td>
            <td>
              <div class="fw-bold">PsikopatNew</div>
            </td>
            <td>
              <i class="bi bi-envelope me-1"></i> anto.@email.com
            </td>
            <td>
              <i class="bi bi-calendar me-1"></i> 13 Januari 2024
            </td>
            <td>
              <i class="bi bi-calendar me-1"></i> 15 Januari 2024
            </td>
            <td>
              <span class="badge bg-success">
                <i class="bi bi-check2-circle me-1"></i> Disetujui
              </span>
            </td>
            <td>
              <div class="dropdown" align="center">
                <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailBukuModal">
                      <i class="bi bi-eye me-2"></i> Lihat Detail
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <i class="bi bi-check-circle me-2"></i> Setujui
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editBukuModal">
                      <i class="bi bi-x-circle me-2"></i> Tolak
                    </a>
                  </li>
                </ul>
              </div>
            </td>
          </tr>

          <!-- Status -->

        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
