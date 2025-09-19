@extends('template.app')

@section("konten")
<div class="container py-4" style="margin-top: -50px;">
  <!-- Judul Halaman -->
  <div class="card shadow-sm border-0 mb-4">
    <div class="card-body d-flex align-items-center">
      <i class="bi bi-book text-primary fs-1 me-3"></i>
      <div>
        <h3 class="fw-bold mb-0">Rak Buku</h3>
        <small class="text-muted">Manajemen koleksi & lokasi rak buku</small>
      </div>
    </div>
  </div>

  <!-- Header Aksi -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold text-secondary mb-0">Daftar Buku</h5>
    <button class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahBukuModal">
      <i class="bi bi-plus-circle me-1"></i> Tambah Buku
    </button>
  </div>

  <!-- Card Table -->
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <!-- Search -->
      <div class="mb-3">
        <input type="search" class="form-control form-control-sm" placeholder="Cari buku...">
      </div>

      <!-- Table -->
      <table class="table table-striped table-hover align-middle mb-0 table-bordered border-secondary-subtle">
        <thead class="table-primary text-center">
          <tr>
            <th>Foto Buku</th>
            <th>Judul Buku</th>
            <th>Jenis Buku</th>
            <th>Nama Rak</th>
            <th>No Rak</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <!-- Contoh Data Buku -->
          <tr>
            <td>
              <img src="../img/photos/buku1.jpeg" class="rounded shadow-sm" alt="Foto Buku" style="width: 100px;">
            </td>
            <td class="text-start">
              <i class="bi bi-journal-bookmark-fill text-primary me-2"></i>
              Belajar Laravel
            </td>
            <td>Pelajaran</td>
            <td>Rak Belajar</td>
            <td>B2</td>
            <td>
              <div class="dropdown">
                <button class="btn btn-sm btn-light border" type="button" data-bs-toggle="dropdown">
                  <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailBukuModal">
                      <i class="bi bi-eye me-2"></i> Lihat Detail
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editBukuModal">
                      <i class="bi bi-pencil-square me-2"></i> Edit
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

<!-- Modal Tambah Buku -->
<div class="modal fade" id="tambahBukuModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-plus-circle text-success me-2"></i>Tambah Buku
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3">
          <!-- Judul -->
          <div class="col-md-6">
            <label class="form-label">Judul Buku</label>
            <input type="text" class="form-control" value="Belajar Laravel" placeholder="Contoh: Belajar Laravel">
          </div>

          <!-- Jenis -->
          <div class="col-md-6">
            <label class="form-label">Jenis Buku</label>
            <input type="text" class="form-control" value="Pelajaran" placeholder="Fiksi / Non-Fiksi / Pelajaran">
          </div>

          <!-- Penerbit -->
          <div class="col-md-6">
            <label class="form-label">Penerbit</label>
            <input type="text" class="form-control" value="Gramedia" placeholder="Contoh: Gramedia">
          </div>

          <!-- Penulis -->
          <div class="col-md-6">
            <label class="form-label">Penulis</label>
            <input type="text" class="form-control" value="Bagas Hidayat" placeholder="Contoh: Bagas Hidayat">
          </div>

          <!-- Kota -->
          <div class="col-md-6">
            <label class="form-label">Kota Terbit</label>
            <input type="text" class="form-control" value="Jakarta" placeholder="Contoh: Jakarta">
          </div>

          <!-- Tahun -->
          <div class="col-md-6">
            <label class="form-label">Tahun Terbit</label>
            <input type="number" class="form-control" value="2025" placeholder="Contoh: 2025">
          </div>

          <!-- Halaman -->
          <div class="col-md-6">
            <label class="form-label">Jumlah Halaman</label>
            <input type="number" class="form-control" value="250" placeholder="Contoh: 250">
          </div>

          <!-- Nama Rak -->
          <div class="col-md-6">
            <label class="form-label">Nama Rak</label>
            <input type="text" class="form-control" value="Rak Belajar" placeholder="Contoh: Rak Belajar">
          </div>

          <!-- Nomor Rak -->
          <div class="col-md-6">
            <label class="form-label">Nomor Rak</label>
            <input type="text" class="form-control" value="B2" placeholder="Contoh: B2">
          </div>

          <!-- Foto Buku -->
          <div class="col-md-6">
            <label class="form-label">Foto Buku</label>
            <input type="file" class="form-control">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-success">Simpan</button>
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
          <i class="bi bi-journal-text me-2 text-primary"></i>Detail Buku
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-3">
          <img src="../img/photos/buku1.jpeg" class="rounded shadow" alt="Foto Buku" style="width: 150px;">
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><b>Judul:</b> Belajar Laravel</li>
          <li class="list-group-item"><b>Jenis:</b> Pelajaran</li>
          <li class="list-group-item"><b>Penerbit:</b> Gramedia</li>
          <li class="list-group-item"><b>Penulis:</b> Bagas Hidayat</li>
          <li class="list-group-item"><b>Kota:</b> Jakarta</li>
          <li class="list-group-item"><b>Tahun:</b> 2025</li>
          <li class="list-group-item"><b>Halaman:</b> 250</li>
          <li class="list-group-item"><b>Rak:</b> Rak Belajar (B2)</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Buku -->
<div class="modal fade" id="editBukuModal" tabindex="-1">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-pencil-square me-2 text-warning"></i>Edit Buku
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form>
        <div class="modal-body">
          <!-- Ganti Foto Buku -->
          <div class="mb-3 text-center">
            <img src="../img/photos/buku1.jpeg" 
                 class="rounded shadow-sm mb-2" 
                 alt="Foto Buku" 
                 style="width: 120px; height: auto;">
            <input type="file" class="form-control form-control-sm mt-2">
          </div>

          <div class="mb-3">
            <label class="form-label">Judul Buku</label>
            <input type="text" class="form-control" value="Belajar Laravel">
          </div>
          <div class="mb-3">
            <label class="form-label">Jenis Buku</label>
            <input type="text" class="form-control" value="Pelajaran">
          </div>
          <div class="mb-3">
            <label class="form-label">Penerbit</label>
            <input type="text" class="form-control" value="Gramedia">
          </div>
          <div class="mb-3">
            <label class="form-label">Penulis</label>
            <input type="text" class="form-control" value="Bagas Hidayat">
          </div>
          <div class="mb-3">
            <label class="form-label">Kota</label>
            <input type="text" class="form-control" value="Jakarta">
          </div>
          <div class="mb-3">
            <label class="form-label">Tahun Terbit</label>
            <input type="number" class="form-control" value="2025">
          </div>
          <div class="mb-3">
            <label class="form-label">Jumlah Halaman</label>
            <input type="number" class="form-control" value="250">
          </div>
          <div class="mb-3">
            <label class="form-label">Rak Buku</label>
            <input type="text" class="form-control" value="Rak Belajar">
          </div>
          <div class="mb-3">
            <label class="form-label">No Rak</label>
            <input type="text" class="form-control" value="B2">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
