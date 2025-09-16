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
    <button class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahRakModal">
      <i class="bi bi-plus-circle me-1"></i> Tambah Buku
    </button>
  </div>

  <!-- Table -->
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <div class="table-responsive">
  <table class="table table-striped table-hover align-middle mb-0 table-bordered border-secondary-subtle">
    <thead class="table-primary text-center">
      <tr>
        <th>Judul</th>
        <th>Jenis</th>
        <th>Penerbit</th>
        <th>Penulis</th>
        <th>Kota</th>
        <th>Tahun</th>
        <th>Halaman</th>
        <th>Rak</th>
        <th>No</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody class="text-center">
      <tr>
        <td>Belajar Laravel</td>
        <td>Pelajaran</td>
        <td>Gramedia</td>
        <td>Bagas Hidayat</td>
        <td>Jakarta</td>
        <td>2025</td>
        <td>250</td>
        <td>Rak Belajar</td>
        <td>B2</td>
        <td>
          <div class="d-flex justify-content-center gap-2">
            <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editRakModal">
              <i class="bi bi-pencil-square"></i> Edit
            </button>
            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#hapusRakModal">
              <i class="bi bi-trash"></i> Hapus
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

<!-- Modal Tambah -->
<div class="modal fade" id="tambahRakModal" tabindex="-1">
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
          <div class="col-md-6">
            <label class="form-label">Judul Buku</label>
            <input type="text" class="form-control" placeholder="Contoh: Belajar Laravel">
          </div>
          <div class="col-md-6">
            <label class="form-label">Jenis Buku</label>
            <input type="text" class="form-control" placeholder="Fiksi / Non-Fiksi / Pelajaran">
          </div>
          <div class="col-md-6">
            <label class="form-label">Penerbit</label>
            <input type="text" class="form-control" placeholder="Contoh: Gramedia">
          </div>
          <div class="col-md-6">
            <label class="form-label">Pencipta</label>
            <input type="text" class="form-control" placeholder="Nama Penulis">
          </div>
          <div class="col-md-6">
            <label class="form-label">Tempat Terbit</label>
            <input type="text" class="form-control" placeholder="Kota">
          </div>
          <div class="col-md-6">
            <label class="form-label">Tahun Terbit</label>
            <input type="number" class="form-control" placeholder="2025">
          </div>
          <div class="col-md-6">
            <label class="form-label">Jumlah Halaman</label>
            <input type="number" class="form-control" placeholder="250">
          </div>
          <div class="col-md-6">
            <label class="form-label">Nama Rak</label>
            <input type="text" class="form-control" placeholder="Rak Belajar">
          </div>
          <div class="col-md-6">
            <label class="form-label">Nomor Rak</label>
            <input type="text" class="form-control" placeholder="B2">
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

<!-- Modal Edit -->
<div class="modal fade" id="editRakModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-pencil-square text-warning me-2"></i>Edit Buku
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Judul Buku</label>
            <input type="text" class="form-control" value="Belajar Laravel">
          </div>
          <div class="col-md-6">
            <label class="form-label">Jenis Buku</label>
            <input type="text" class="form-control" value="Pelajaran">
          </div>
          <div class="col-md-6">
            <label class="form-label">Penerbit</label>
            <input type="text" class="form-control" value="Gramedia">
          </div>
          <div class="col-md-6">
            <label class="form-label">Pencipta</label>
            <input type="text" class="form-control" value="Bagas Hidayat">
          </div>
          <div class="col-md-6">
            <label class="form-label">Tempat Terbit</label>
            <input type="text" class="form-control" value="Jakarta">
          </div>
          <div class="col-md-6">
            <label class="form-label">Tahun Terbit</label>
            <input type="number" class="form-control" value="2025">
          </div>
          <div class="col-md-6">
            <label class="form-label">Jumlah Halaman</label>
            <input type="number" class="form-control" value="250">
          </div>
          <div class="col-md-6">
            <label class="form-label">Nama Rak</label>
            <input type="text" class="form-control" value="Rak Belajar">
          </div>
          <div class="col-md-6">
            <label class="form-label">Nomor Rak</label>
            <input type="text" class="form-control" value="B2">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-warning">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="hapusRakModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title mb-0">
          <i class="bi bi-trash me-2"></i>Hapus Buku
        </h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <p>Apakah yakin ingin menghapus buku <strong>"Belajar Laravel"</strong>?</p>
        <small class="text-muted">Tindakan ini tidak bisa dibatalkan.</small>
      </div>
      <div class="modal-footer justify-content-center">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-danger">Ya, Hapus</button>
      </div>
    </div>
  </div>
</div>


@endsection
