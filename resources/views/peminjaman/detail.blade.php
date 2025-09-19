@extends('template.app')

@section("konten")

<div class="container mt-4">
  <p class="text-muted">Status Disetujui</p>

  <div class="card shadow-sm">
    <div class="card-body p-0">
      <table class="table align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th>Nama Peminjam</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
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
               <div>
                  <div class="fw-bold">PsikopatNew</div>
                </div>
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
               <div>
                  <div class="fw-bold">PsikopatNew</div>
                </div>
            </td></td>
            <td>
              <i class="bi bi-calendar me-1"></i> 11 Januari 2024
            </td>
            <td>
              <i class="bi bi-calendar me-1"></i> 14 Januari 2024
            </td>
            <td>
              <span class="badge bg-success">
                <i class="bi bi-check2-circle me-1"></i> Disetujui
              </span>
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
               <div>
                  <div class="fw-bold">PsikopatNew</div>
                </div>
            </td>
            <td>
              <i class="bi bi-calendar me-1"></i> 10 Januari 2024
            </td>
            <td>
              <i class="bi bi-calendar me-1"></i> 13 Januari 2024
            </td>
            <td>
              <span class="badge bg-success">
                <i class="bi bi-check2-circle me-1"></i> Disetujui
              </span>
            </td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="container mt-4">
  <p class="text-muted">Status Ditolak</p>

  <div class="card shadow-sm">
    <div class="card-body p-0">
      <table class="table align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th>Nama Peminjam</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
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
               <div>
                  <div class="fw-bold">PsikopatNew</div>
                </div>
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
               <div>
                  <div class="fw-bold">PsikopatNew</div>
                </div>
            </td></td>
            <td>
              <i class="bi bi-calendar me-1"></i> 14 Januari 2024
            </td>
            <td>
              <i class="bi bi-calendar me-1"></i> 14 Januari 2024
            </td>
             <td>
              <span class="badge bg-danger">
                <i class="bi bi-check2-circle me-1"></i> Ditolak
              </span>
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
               <div>
                  <div class="fw-bold">PsikopatNew</div>
                </div>
            </td>
            <td>
              <i class="bi bi-calendar me-1"></i> 13 Januari 2024
            </td>
            <td>
              <i class="bi bi-calendar me-1"></i> 13 Januari 2024
            </td>
             <td>
              <span class="badge bg-danger">
                <i class="bi bi-check2-circle me-1"></i> Ditolak
              </span>
            </td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
