@extends('template.app')

@section("konten")
<div class="container py-4" style="margin-top: -50px;">
  <!-- Judul Halaman -->
  <div class="card shadow-sm border-0 mb-4">
    <div class="card-body d-flex align-items-center">
      <i class="bi bi-people text-primary fs-1 me-3"></i>
      <div>
        <h3 class="fw-bold mb-0">Manajemen User</h3>
        <small class="text-muted">Kelola akun pengguna & status keanggotaan</small>
      </div>
    </div>
  </div>

  <!-- Header Aksi -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold text-secondary mb-0">Daftar User</h5>
    <button class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahUserModal">
      <i class="bi bi-plus-circle me-1"></i> Tambah User
    </button>
  </div>

  <!-- Card Table -->
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <!-- Search -->
      <div class="mb-3">
        <input type="search" class="form-control form-control-sm" placeholder="Cari user...">
      </div>

      <!-- Table -->
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
          <!-- User 1 -->
          <tr>
            <td class="text-start">
              <img src="https://ui-avatars.com/api/?name=Enggal+Dwi" class="rounded-circle me-2" width="32" height="32">
              Enggal Dwi
            </td>
            <td>enggal@example.com</td>
            <td>USR001</td>
            <td>Laki-laki</td>
            <td>
              <button class="btn btn-sm btn-success toggle-status">Aktif</button>
            </td>
            <td>
              <div class="dropdown">
                <button class="btn btn-sm btn-light border" type="button" data-bs-toggle="dropdown">
                  <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailUserModal"><i class="bi bi-eye me-2"></i> Lihat Detail</a></li>
                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editUserModal"><i class="bi bi-pencil-square me-2"></i> Edit</a></li>
                </ul>
              </div>
            </td>
          </tr>

          <!-- User 2 -->
          <tr>
            <td class="text-start">
              <img src="https://ui-avatars.com/api/?name=Antooks" class="rounded-circle me-2" width="32" height="32">
              antooks
            </td>
            <td>antoks@example.com</td>
            <td>USR002</td>
            <td>Laki-laki</td>
            <td>
              <button class="btn btn-sm btn-danger toggle-status">Nonaktif</button>
            </td>
            <td>
              <div class="dropdown">
                <button class="btn btn-sm btn-light border" type="button" data-bs-toggle="dropdown">
                  <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailUserModal"><i class="bi bi-eye me-2"></i> Lihat Detail</a></li>
                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editUserModal"><i class="bi bi-pencil-square me-2"></i> Edit</a></li>
                </ul>
              </div>
            </td>
          </tr>

          <!-- User 3 -->
          <tr>
            <td class="text-start">
              <img src="https://ui-avatars.com/api/?name=Bagasss" class="rounded-circle me-2" width="32" height="32">
              bagasss
            </td>
            <td>bagas@example.com</td>
            <td>USR003</td>
            <td>Laki-laki</td>
            <td>
              <button class="btn btn-sm btn-success toggle-status">Aktif</button>
            </td>
            <td>
              <div class="dropdown">
                <button class="btn btn-sm btn-light border" type="button" data-bs-toggle="dropdown">
                  <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailUserModal"><i class="bi bi-eye me-2"></i> Lihat Detail</a></li>
                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editUserModal"><i class="bi bi-pencil-square me-2"></i> Edit</a></li>
                </ul>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="tambahUserModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-person-plus text-success me-2"></i>Tambah User
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" placeholder="Contoh: Bagas Hidayat">
          </div>
          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" placeholder="nama@email.com">
          </div>
          <div class="col-md-6">
            <label class="form-label">NIS</label>
            <input type="text" class="form-control" placeholder="USR001">
          </div>
          <div class="col-md-6">
            <label class="form-label">Jenis Kelamin</label>
            <select class="form-select">
              <option selected disabled>-- Pilih --</option>
              <option>Laki-laki</option>
              <option>Perempuan</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Status</label>
            <select class="form-select">
              <option>Aktif</option>
              <option>Nonaktif</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" placeholder="Minimal 6 karakter">
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

<!-- Modal Lihat Detail -->
<div class="modal fade" id="detailUserModal" tabindex="-1">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-person-badge me-2 text-primary"></i>Detail User
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-3">
          <img src="https://ui-avatars.com/api/?name=Enggal+Dwi" class="rounded-circle mb-2" width="80" height="80">
          <h5 class="mb-0">Enggal Dwi</h5>
          <small class="text-muted">USR001</small>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><b>Email:</b> enggal@example.com</li>
          <li class="list-group-item"><b>Jenis Kelamin:</b> Laki-laki</li>
          <li class="list-group-item"><b>Status:</b> Aktif</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit User -->
<div class="modal fade" id="editUserModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-pencil-square text-warning me-2"></i>Edit User
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" value="Enggal Dwi">
          </div>
          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" value="enggal@example.com">
          </div>
          <div class="col-md-6">
            <label class="form-label">NIS</label>
            <input type="text" class="form-control" value="USR001">
          </div>
          <div class="col-md-6">
            <label class="form-label">Jenis Kelamin</label>
            <select class="form-select">
              <option selected>Laki-laki</option>
              <option>Perempuan</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Status</label>
            <select class="form-select">
              <option selected>Aktif</option>
              <option>Nonaktif</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
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

<!-- JS -->
<script>
  // Toggle Aktif/Nonaktif
  document.querySelectorAll('.toggle-status').forEach(btn => {
    btn.addEventListener('click', function () {
      if (this.classList.contains('btn-success')) {
        this.classList.remove('btn-success');
        this.classList.add('btn-danger');
        this.textContent = 'Nonaktif';
      } else {
        this.classList.remove('btn-danger');
        this.classList.add('btn-success');
        this.textContent = 'Aktif';
      }
    });
  });
</script>
@endsection
