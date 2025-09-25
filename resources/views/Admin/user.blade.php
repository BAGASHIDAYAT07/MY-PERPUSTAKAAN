@extends('template.app')

@section("konten")
<div class="container-fluid px-3" style="margin-top: -25px;">
  <!-- Judul Halaman -->
  <div class="d-flex align-items-center justify-content-between bg-white shadow-sm p-3 rounded mb-4">
    <div class="d-flex align-items-center">
      <i class="bi bi-people text-primary fs-1 me-3"></i>
      <div>
        <h3 class="fw-bold mb-0">Manajemen User</h3>
        <small class="text-muted">Kelola akun pengguna & status keanggotaan</small>
      </div>
    </div>
  </div>

  <!-- Header Aksi -->
  <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
    <h5 class="fw-semibold text-secondary mb-0">Daftar User</h5>
    <button class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahUserModal">
      <i class="bi bi-plus-circle me-1"></i> Tambah User
    </button>
  </div>

    {{-- ✅ Pesan Validasi --}}
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- ✅ Pesan Sukses --}}
    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    {{-- ✅ Pesan Error Umum --}}
    @if (session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
    @endif



  <!-- Card Table -->
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <!-- Search dengan Filter -->
      <div class="mb-3 d-flex gap-2">
        <div class="input-group input-group-sm" style="max-width: 300px;">
          <span class="input-group-text bg-white border-end-0">
            <i class="bi bi-search text-muted"></i>
          </span>
          <input type="search" id="searchInput" class="form-control border-start-0" placeholder="Cari user...">
        </div>

        <!-- Dropdown Filter -->
        <select id="searchFilter" class="form-select form-select-sm" style="max-width: 150px;">
          <option value="all">Semua</option>
          <option value="0">No</option>
          <option value="1">Nama</option>
          <option value="2">Email</option>
          <option value="3">NIS</option>
          <option value="4">Jenis Kelamin</option>
          <option value="5">Status</option>
        </select>
      </div>



      <table class="table table-striped table-hover align-middle mb-0 table-bordered border-secondary-subtle">
    <thead class="table-primary text-center">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>NIS</th>
            <th>Jenis Kelamin</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody class="text-center">
          @foreach ($user as $u)
              <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td class="text-start">
                      <img src="https://ui-avatars.com/api/?name={{ urlencode($u->name) }}" 
                          class="rounded-circle me-2" width="32" height="32">
                      {{ $u->name }}
                  </td>
                  <td>{{ $u->email }}</td>
                  <td>{{ $u->NIS }}</td>
                  <td>{{ $u->jenisKelamin }}</td>
                  <td>
                  <form action="{{ route('user.toggle-status', $u->id) }}" method="POST">
                          @csrf
                          <button type="submit" 
                              class="btn btn-sm {{ $u->status == 1 ? 'btn-success' : 'btn-danger' }}">
                              {{ $u->status == 1 ? 'Aktif' : 'Nonaktif' }}
                          </button>
                      </form>
                  </td>
                  <td>
                      <div class="dropdown">
                          <button class="btn btn-sm btn-light border" type="button" data-bs-toggle="dropdown">
                              <i class="bi bi-three-dots-vertical"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                              <li>
                                  <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailUserModal{{ $u->id }}">
                                      <i class="bi bi-eye me-2"></i> Lihat Detail
                                  </a>
                              </li>
                              <li>
                                  <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $u->id }}">
                                      <i class="bi bi-pencil-square me-2"></i> Edit
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </td>
              </tr>

              <!-- Modal Detail User -->
              <div class="modal fade" id="detailUserModal{{ $u->id }}" tabindex="-1">
                <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title fw-bold">
                        <i class="bi bi-person-badge me-2 text-primary"></i>Detail User
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <div class="text-center mb-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($u->name) }}" 
                            class="rounded-circle mb-2" width="80" height="80">
                        <h5 class="mb-0">{{ $u->name }}</h5>
                        <small class="text-muted">{{ $u->NIS }}</small>
                      </div>
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Email:</b> {{ $u->email }}</li>
                        <li class="list-group-item"><b>Jenis Kelamin:</b> {{ $u->jenisKelamin }}</li>
                        <li class="list-group-item"><b>Status:</b> {{ $u->status == 1 ? 'Aktif' : 'Nonaktif' }}</li>
                      </ul>
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Modal Edit User -->
              <div class="modal fade" id="editUserModal{{ $u->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header bg-light">
                      <h5 class="modal-title fw-bold">
                        <i class="bi bi-pencil-square text-warning me-2"></i> Edit User
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{ route('user.update', $u->id) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <div class="modal-body">
                        <div class="row g-3">
                          <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" name="namaLengkap" class="form-control" value="{{ $u->name }}">
                          </div>

                          <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $u->email }}">
                          </div>

                          <div class="col-md-6">
                            <label class="form-label fw-semibold">NIS</label>
                            <input type="text" name="nis" class="form-control" value="{{ $u->NIS }}">
                          </div>

                          <div class="col-md-6">
                            <label class="form-label fw-semibold">Jenis Kelamin</label>
                            <select class="form-select" name="gender">
                              <option value="laki-laki" {{ $u->jenisKelamin == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                              <option value="perempuan" {{ $u->jenisKelamin == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                          </div>

                          <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select class="form-select" name="status">
                              <option value="1" {{ $u->status == 1 ? 'selected' : '' }}>Aktif</option>
                              <option value="0" {{ $u->status == 0 ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                          </div>

                          <div class="col-md-6">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
                          </div>
                        </div>
                      </div>

                      <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
          @endforeach
        </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="tambahUserModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-person-plus text-success me-2"></i>Tambah User
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" action="{{ route('user.post') }}"  method="POST">
          @csrf
          <div class="col-md-6">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="namaLengkap" class="form-control" placeholder="Isi Nama Name">
          </div>
          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="nama@email.com">
          </div>
          <div class="col-md-6">
            <label class="form-label">NIS</label>
            <input type="text" name="nis" class="form-control" placeholder="12345678901">
          </div>
          <div class="col-md-6">
            <label class="form-label">Jenis Kelamin</label>
            <select class="form-select" name="gender">
              <option selected disabled>-- Pilih --</option>
              <option value="laki-laki">Laki-laki</option>
              <option value="perempuan">Perempuan</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Status</label>
            <select class="form-select" name="status">
              <option value="1">Aktif</option>
              <option value="0">Nonaktif</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter">
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-success">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit User -->
<div class="modal fade" id="editUserModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
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

  document.getElementById("searchInput").addEventListener("keyup", filterTable);
  document.getElementById("searchFilter").addEventListener("change", filterTable);

  function filterTable() {
    let input = document.getElementById("searchInput").value.toLowerCase();
    let filter = document.getElementById("searchFilter").value;
    let rows = document.querySelectorAll("table tbody tr");

    rows.forEach(function(row) {
      let cells = row.getElementsByTagName("td");
      let match = false;

      if (filter === "all") {
        // cek semua kolom
        for (let i = 0; i < cells.length; i++) {
          let text = cells[i].innerText.toLowerCase().trim();
          if (text.includes(input)) {
            match = true;
            break;
          }
        }
      } else {
        let colIndex = parseInt(filter);

        // khusus kolom Nama (index 1), ambil teks tanpa gambar
        if (colIndex === 1) {
          let namaCell = row.querySelector("td:nth-child(2)");
          if (namaCell && namaCell.innerText.toLowerCase().includes(input)) {
            match = true;
          }
        } else {
          if (cells[colIndex] && cells[colIndex].innerText.toLowerCase().includes(input)) {
            match = true;
          }
        }
      }

      row.style.display = match ? "" : "none";
    });
  }
</script>
@endsection
