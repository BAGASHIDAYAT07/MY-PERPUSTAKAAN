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
      <!-- Select All & Export -->
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <input type="checkbox" id="selectAll"> 
          <label for="selectAll" class="ms-1">Pilih semua</label>
        </div>
        <button class="btn btn-outline-primary btn-sm">
          <i class="bi bi-box-arrow-up"></i> Export selected
        </button>
      </div>

      <!-- Search -->
      <div class="mb-3">
        <input type="search" class="form-control form-control-sm" placeholder="Cari user...">
      </div>

      <!-- Table -->
      <div class="table-responsive">
        <table class="table table-striped table-hover align-middle mb-0 table-bordered border-secondary-subtle">
          <thead class="table-primary text-center">
            <tr>
              <th></th>
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
              <td><input type="checkbox"></td>
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
                <div class="d-flex justify-content-center gap-2">
                  <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editUserModal">
                    <i class="bi bi-pencil-square"></i> Edit
                  </button>
                  <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#hapusUserModal">
                    <i class="bi bi-trash"></i> Hapus
                  </button>
                </div>
              </td>
            </tr>

            <!-- User 2 -->
            <tr>
              <td><input type="checkbox"></td>
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
                <div class="d-flex justify-content-center gap-2">
                  <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editUserModal">
                    <i class="bi bi-pencil-square"></i> Edit
                  </button>
                  <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#hapusUserModal">
                    <i class="bi bi-trash"></i> Hapus
                  </button>
                </div>
              </td>
            </tr>

            <!-- User 3 -->
            <tr>
              <td><input type="checkbox"></td>
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
                <div class="d-flex justify-content-center gap-2">
                  <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editUserModal">
                    <i class="bi bi-pencil-square"></i> Edit
                  </button>
                  <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#hapusUserModal">
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
<div class="modal fade" id="tambahUserModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-plus-circle text-success me-2"></i>Tambah User
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" placeholder="Nama lengkap">
          </div>
          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" placeholder="user@example.com">
          </div>
          <div class="col-md-6">
            <label class="form-label">NIS</label>
            <input type="text" class="form-control" placeholder="USR001">
          </div>
          <div class="col-md-6">
            <label class="form-label">Jenis Kelamin</label>
            <select class="form-select">
              <option value="L">Laki-laki</option>
              <option value="P">Perempuan</option>
            </select>
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
            <label class="form-label">Nama</label>
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
<div class="modal fade" id="hapusUserModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title mb-0">
          <i class="bi bi-trash me-2"></i>Hapus User
        </h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <p>Apakah yakin ingin menghapus user <strong>"Enggal Dwi"</strong>?</p>
        <small class="text-muted">Tindakan ini tidak bisa dibatalkan.</small>
      </div>
      <div class="modal-footer justify-content-center">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-danger">Ya, Hapus</button>
      </div>
    </div>
  </div>
</div>

<!-- JS -->
<script>
  // Select All Checkbox
  document.getElementById('selectAll').addEventListener('click', function () {
    const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
    checkboxes.forEach(cb => cb.checked = this.checked);
  });

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
