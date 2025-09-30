@extends('template.app')

@section("konten")
<div class="container-fluid px-3" style="margin-top: -25px;">
  <!-- Judul Halaman -->
  <div class="d-flex align-items-center justify-content-between bg-white shadow-sm p-3 rounded mb-4">
    <div class="d-flex align-items-center">
      <i class="bi bi-book text-primary fs-1 me-3"></i>
      <div>
        <h3 class="fw-bold mb-0">Rak Buku</h3>
        <small class="text-muted">Manajemen koleksi & lokasi rak buku</small>
      </div>
    </div>
  </div>

  <!-- Header Aksi -->
  <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
    <h5 class="fw-semibold text-secondary mb-0">Daftar Buku</h5>
    <button class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahBukuModal">
      <i class="bi bi-plus-circle me-1"></i> Tambah Buku
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

{{-- ✅ Pesan Error --}}
@if (session('error'))
  <div class="alert alert-danger">
    {{ session('error') }}
  </div>
@endif


  <!-- Card Table -->
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <!-- Card Table -->
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <!-- Search dengan Filter -->
<div class="mb-3 d-flex gap-2">
  <div class="input-group input-group-sm" style="max-width: 300px;">
    <span class="input-group-text bg-white border-end-0">
      <i class="bi bi-search text-muted"></i>
    </span>
    <input type="search" id="searchInput" class="form-control border-start-0" placeholder="Cari buku...">
  </div>

  <!-- Dropdown Filter -->
  <select id="searchFilter" class="form-select form-select-sm" style="max-width: 180px;">
    <option value="all">Semua</option>
    <option value="1">Judul Buku</option>
    <option value="2">Jenis Buku</option>
    <option value="3">Nama Rak</option>
    <option value="4">No Rak</option>
    <option value="5">Status</option>
  </select>
</div>


      <!-- Table Responsive -->
  <table class="table table-striped table-hover align-middle mb-0 table-bordered border-secondary-subtle">
    <thead class="table-primary text-center">
      <tr>
        <th>Foto Buku</th>
        <th>Judul Buku</th>
        <th>Jenis Buku</th>
        <th>Nama Rak</th>
        <th>No Rak</th>
        <th>Status</th> <!-- Tambahan -->
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody class="text-center">
  @foreach ($buku as $item)
    <tr>
      <td>
        <img src="{{ $item->foto }}" 
             class="rounded shadow-sm img-fluid" 
             alt="Foto Buku" 
             style="max-width: 100px;">
      </td>
      <td class="text-start">
        <i class="bi bi-journal-bookmark-fill text-primary me-2"></i>
        {{ $item->judul }}
      </td>
      <td>{{ $item->JenisBuku }}</td>
      <td>{{ $item->namarak ?? '-' }}</td>
      <td>{{ $item->norak ?? '-' }}</td>
      <td>
        <form action="{{ route('buku.toggleStatus', $item->id) }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" 
            class="btn btn-sm {{ $item->status ? 'btn-success' : 'btn-danger' }}">
      {{ $item->status ? 'Aktif' : 'Nonaktif' }}
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
              <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailBukuModal-{{ $item->id }}">
                <i class="bi bi-eye me-2"></i> Lihat Detail
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editBukuModal-{{ $item->id }}">
                <i class="bi bi-pencil-square me-2"></i> Edit
              </a>
            </li>
          </ul>
        </div>
      </td>
    </tr>

    <!-- view buku -->
    <div class="modal fade" id="detailBukuModal-{{ $item->id }}" tabindex="-1">
  <div class="modal-dialog modal-md modal-dialog-centered modal-fullscreen-sm-down">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-journal-text me-2 text-primary"></i>Detail Buku
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-3">
          <img src="{{ $item->foto }}" 
               class="rounded shadow img-fluid" 
               alt="Foto Buku" 
               style="max-width: 150px;">
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><b>Judul Buku:</b> {{ $item->judul }}</li>
          <li class="list-group-item"><b>Deskripsi Buku:</b> {{ $item->deskripsi }}</li>
          <li class="list-group-item"><b>Jenis:</b> {{ $item->JenisBuku }}</li>
          <li class="list-group-item"><b>Penerbit:</b> {{ $item->Penerbit }}</li>
          <li class="list-group-item"><b>Pencipta:</b> {{ $item->Pencipta }}</li>
          <li class="list-group-item"><b>Kota:</b> {{ $item->TempatTerbit }}</li>
          <li class="list-group-item"><b>Tahun:</b> {{ $item->TahunTerbit }}</li>
          <li class="list-group-item"><b>Halaman:</b> {{ $item->JumlahHalaman }}</li>
          <li class="list-group-item"><b>Nama Rak:</b> {{ $item->namarak ?? '-' }}</li>
          <li class="list-group-item"><b>No Rak:</b> {{ $item->norak ?? '-' }}</li>
          <li class="list-group-item"><b>Status:</b> 
            @if ($item->status)
              <span class="badge bg-success">Aktif</span>
            @else
              <span class="badge bg-danger">Nonaktif</span>
            @endif
          </li>
        </ul>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- edit buku -->
<div class="modal fade" id="editBukuModal-{{ $item->id }}" tabindex="-1">
  <div class="modal-dialog modal-md modal-dialog-centered modal-fullscreen-sm-down">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-pencil-square me-2 text-warning"></i>Edit Buku
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Form Update -->
      <form action="{{ route('buku.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <!-- Ganti Foto Buku -->
          <div class="mb-3 text-center">
            <img src="{{ $item->foto }}" 
                 class="rounded shadow-sm mb-2 img-fluid" 
                 alt="Foto Buku" 
                 style="max-width: 120px;">
            <input type="file" name="foto" class="form-control form-control-sm mt-2" value="{{ $item->judul }}" placeholder="Masukkan judul buku">
          </div>

          <div class="mb-3">
            <label class="form-label">Judul Buku</label>
            <input type="text" name="judul" class="form-control" value="{{ $item->judul }}" placeholder="Tuliskan deskripsi singkat buku">
          </div>

          <div class="mb-3">
            <label class="form-label">Deskripsi Buku</label>
            <input type="text" name="deskripsi" class="form-control" value="{{ $item->deskripsi }}" placeholder="Contoh: Fiksi, Non-Fiksi, Sejarah">
          </div>

          <div class="mb-3">
            <label class="form-label">Jenis Buku</label>
            <input type="text" name="JenisBuku" class="form-control" value="{{ $item->JenisBuku }}" placeholder="Masukkan nama penerbit">
          </div>

          <div class="mb-3">
            <label class="form-label">Penerbit</label>
            <input type="text" name="Penerbit" class="form-control" value="{{ $item->Penerbit }}" placeholder="Masukkan nama penulis/pencipta">
          </div>

          <div class="mb-3">
            <label class="form-label">Pencipta</label>
            <input type="text" name="Pencipta" class="form-control" value="{{ $item->Pencipta }}" placeholder="Contoh: Jakarta, Bandung">
          </div>

          <div class="mb-3">
            <label class="form-label">Kota (Tempat Terbit)</label>
            <input type="text" name="TempatTerbit" class="form-control" value="{{ $item->TempatTerbit }}" placeholder="Masukkan tahun terbit (contoh: 2023)">
          </div>

          <div class="mb-3">
            <label class="form-label">Tahun Terbit</label>
            <input type="number" name="TahunTerbit" class="form-control" value="{{ $item->TahunTerbit }}">
          </div>

          <div class="mb-3">
            <label class="form-label">Jumlah Halaman</label>
            <input type="number" name="JumlahHalaman" class="form-control" value="{{ $item->JumlahHalaman }}">
          </div>

          <div class="mb-3">
            <label class="form-label">Nama Rak</label>
            <input type="text" name="namarak" class="form-control" value="{{ $item->namarak }}">
          </div>

          <div class="mb-3">
            <label class="form-label">No Rak</label>
            <input type="text" name="norak" class="form-control" value="{{ $item->norak }}">
          </div>

          <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
              <option value="1" {{ $item->status ? 'selected' : '' }}>Aktif</option>
              <option value="0" {{ !$item->status ? 'selected' : '' }}>Nonaktif</option>
            </select>
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
  @endforeach
</tbody>

  </table>
</div>
    </div>
  </div>
</div>

<!-- Modal Tambah Buku -->
<div class="modal fade" id="tambahBukuModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-plus-circle text-success me-2"></i>Tambah Buku
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" action="{{ route('buku.tambahbuku') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Judul -->
    <div class="col-md-6">
        <label class="form-label">Judul Buku</label>
        <input type="text" name="judul" class="form-control">
    </div>

    <!-- deskripsi -->
    <div class="col-md-6">
        <label class="form-label">Deskripsi Buku</label>
        <input type="text" name="deskripsi" class="form-control">
    </div>

    <!-- Jenis Buku -->
    <div class="col-md-6">
        <label class="form-label">Jenis Buku</label>
        <input type="text" name="JenisBuku" class="form-control">
    </div>

    <!-- Penerbit -->
    <div class="col-md-6">
        <label class="form-label">Penerbit</label>
        <input type="text" name="Penerbit" class="form-control">
    </div>

    <!-- Penulis (Pencipta) -->
    <div class="col-md-6">
        <label class="form-label">Pencipta</label>
        <input type="text" name="Pencipta" class="form-control">
    </div>

    <!-- Kota (TempatTerbit) -->
    <div class="col-md-6">
        <label class="form-label">Tempat Terbit</label>
        <input type="text" name="TempatTerbit" class="form-control">
    </div>

    <!-- Tahun -->
    <div class="col-md-6">
        <label class="form-label">Tahun Terbit</label>
        <input type="text" name="TahunTerbit" class="form-control" placeholder="2024">
    </div>

    <!-- Halaman -->
    <div class="col-md-6">
        <label class="form-label">Jumlah Halaman</label>
        <input type="number" name="JumlahHalaman" class="form-control">
    </div>

    <!-- Foto Buku -->
    <div class="col-md-6">
        <label class="form-label">Foto Buku</label>
        <input type="file" name="foto" class="form-control">
    </div>

    <!-- nama rak -->
    <div class="col-md-6">
        <label class="form-label">Nama Rak</label>
        <input type="text" name="namarak" class="form-control">
    </div>

    <!-- no rak -->
    <div class="col-md-6">
        <label class="form-label">No rak</label>
        <input type="number" name="norak" class="form-control">
    </div>

    <!-- Status -->
    <div class="col-md-6">
      <label class="form-label">Status</label>
      <select class="form-select" name="status">
        <option value="1">Aktif</option>
        <option value="0">Nonaktif</option>
      </select>
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


<!-- Script Toggle Status -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
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
  });

  document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.getElementById("searchInput");
  const searchFilter = document.getElementById("searchFilter");
  const rows = document.querySelectorAll("table tbody tr");

  function filterTable() {
    const keyword = searchInput.value.toLowerCase();
    const filter = searchFilter.value;

    rows.forEach(row => {
      let cells = row.getElementsByTagName("td");
      let match = false;

      if (filter === "all") {
        // cari di semua kolom
        for (let i = 0; i < cells.length; i++) {
          if (cells[i].innerText.toLowerCase().includes(keyword)) {
            match = true;
            break;
          }
        }
      } else {
        // cari di kolom tertentu
        const colIndex = parseInt(filter);
        if (cells[colIndex] && cells[colIndex].innerText.toLowerCase().includes(keyword)) {
          match = true;
        }
      }

      row.style.display = match ? "" : "none";
    });
  }

  searchInput.addEventListener("keyup", filterTable);
  searchFilter.addEventListener("change", filterTable);
});
</script>
@endsection
