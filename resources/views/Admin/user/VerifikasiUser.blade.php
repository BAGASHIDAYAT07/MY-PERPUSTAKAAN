@extends('template.app')

@section("konten")

<div class="container mt-4">
  <h3 class="fw-bold">Daftar Pengguna</h3>
  <p class="text-muted">Kelola verifikasi pengguna yang ditampilkan</p>

  <div class="card shadow-sm">
    <div class="card-body p-0">
      <table class="table align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th>Pengguna</th>
            <th>Email</th>
            <th>Tanggal Daftar</th>
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
              <i class="bi bi-envelope me-1"></i> bagas.@email.com
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
              <button class="btn btn-sm btn-outline-danger" disabled>
                <i class="bi bi-check2-circle me-1"></i> Ditolak
              </button>
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
              <i class="bi bi-envelope me-1"></i> enggal.@email.com
            </td>
            <td>
              <i class="bi bi-calendar me-1"></i> 14 Januari 2024
            </td>
            <td>
              <span class="badge bg-light text-dark border">
                <i class="bi bi-clock me-1"></i> Menunggu Verifikasi
              </span>
            </td>
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
              <i class="bi bi-envelope me-1"></i> anto.@email.com
            </td>
            <td>
              <i class="bi bi-calendar me-1"></i> 13 Januari 2024
            </td>
            <td>
              <span class="badge bg-success">
                <i class="bi bi-check2-circle me-1"></i> Disetujui
              </span>
            </td>
            <td>
              <button class="btn btn-sm btn-outline-success" disabled>
                <i class="bi bi-check2-circle me-1"></i> Disetujui
              </button>
            </td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
