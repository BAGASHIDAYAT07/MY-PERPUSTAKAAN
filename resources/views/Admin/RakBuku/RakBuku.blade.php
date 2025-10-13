@extends('template.app')

@section("konten")
<style>
  /* ✨ Style Modal Detail Buku (Samain dengan versi User) */
  .modal-content {
    border-radius: 1rem;
    border: none;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
  }

  .modal-header {
    background-color: #fff;
    border: none;
    padding: 1rem 1.5rem;
  }

  .modal-header h5 {
    font-weight: 700;
    color: #0d6efd;
  }

  .modal-body {
    padding: 1.5rem;
  }

  .modal-body img {
    border-radius: 0.75rem;
    height: 320px;
    width: 100%;
    object-fit: cover;
  }

  .modal-body .detail-item {
    padding: 0.65rem 0;
    border-bottom: 1px solid #dee2e6;
    font-size: 0.95rem;
  }

  .modal-body .detail-item:last-child {
    border-bottom: none;
  }

  .modal-body strong {
    color: #212529;
  }

  .modal-footer {
    border-top: none;
    background-color: #fff;
    padding: 1rem 1.5rem;
  }

  .modal-footer .btn {
    border-radius: 0.6rem;
    font-weight: 500;
  }

  @media (max-width: 768px) {
    .modal-body img {
      max-height: 250px;
    }
  }
</style>


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
        <th>No</th>
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
      <td>{{ $loop->iteration }}</td>
      <td>
        <img src="{{ asset('storage/' . $item->foto) }}" 
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

    
<!-- Modal Detail Buku -->
<div class="modal fade" id="detailBukuModal-{{ $item->id }}" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header bg-white border-0">
        <h5 class="modal-title fw-bold text-primary">
          <i class="bi bi-journal-text me-2"></i>Detail Buku
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="row g-3">
          <!-- Gambar Buku -->
          <div class="col-md-4">
            <img src="{{ asset('storage/' . $item->foto) }}" class="img-fluid rounded shadow-sm" alt="Foto Buku">
          </div>

          <!-- Detail Buku -->
          <div class="col-md-8">
            <div class="detail-item"><strong>Judul Buku:</strong><br>{{ $item->judul }}</div>
            <div class="detail-item"><strong>Deskripsi Buku:</strong><br>{{ $item->deskripsi }}</div>
            <div class="detail-item"><strong>Jenis Buku:</strong><br>{{ $item->JenisBuku }}</div>
            <div class="detail-item"><strong>Penerbit:</strong><br>{{ $item->Penerbit }}</div>
            <div class="detail-item"><strong>Pencipta:</strong><br>{{ $item->Pencipta }}</div>
            <div class="detail-item"><strong>Kota:</strong><br>{{ $item->TempatTerbit }}</div>
            <div class="detail-item"><strong>Tahun Terbit:</strong><br>{{ $item->TahunTerbit }}</div>
            <div class="detail-item"><strong>Halaman:</strong><br>{{ $item->JumlahHalaman }}</div>
            <div class="detail-item"><strong>Rak:</strong><br>{{ $item->namarak ?? '-' }} / {{ $item->norak ?? '-' }}</div>
            <div class="detail-item"><strong>Status:</strong><br>
              @if ($item->status)
                <span class="badge bg-success">Aktif</span>
              @else
                <span class="badge bg-danger">Nonaktif</span>
              @endif
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer border-0">
        <button type="button" class="btn btn-danger border" data-bs-dismiss="modal">
          <i class="bi bi-x-circle"></i> Tutup
        </button>
      </div>
    </div>
  </div>
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
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
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
<div class="mt-3 d-flex justify-content-end mx-3">
  {{ $buku->links('pagination::bootstrap-5') }}
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
        <input type="text" name="judul" class="form-control" placeholder="Masukan Judul">
    </div>

    <!-- deskripsi -->
    <div class="col-md-6">
        <label class="form-label">Deskripsi Buku</label>
        <input type="text" name="deskripsi" class="form-control" placeholder="Masukan Deskripsi">
    </div>

    <!-- Jenis Buku -->
    <div class="col-md-6">
        <label class="form-label">Jenis Buku</label>
        <input type="text" name="JenisBuku" class="form-control" placeholder="Masukan Jenis Buku">
    </div>

    <!-- Penerbit -->
    <div class="col-md-6">
        <label class="form-label">Penerbit</label>
        <input type="text" name="Penerbit" class="form-control" placeholder="Masukan Nama Penerbit">
    </div>

    <!-- Penulis (Pencipta) -->
    <div class="col-md-6">
        <label class="form-label">Pencipta</label>
        <input type="text" name="Pencipta" class="form-control" placeholder="Masukan Nama Pencipta">
    </div>

    <!-- Kota (TempatTerbit) -->
    <div class="col-md-6">
        <label class="form-label">Tempat Terbit</label>
        <input type="text" name="TempatTerbit" class="form-control" placeholder="Masukan Tempat Terbit">
    </div>

    <!-- Tahun -->
    <div class="col-md-6">
        <label class="form-label">Tahun Terbit</label>
        <input type="text" name="TahunTerbit" class="form-control" placeholder="Masukan Tahun Terbit">
    </div>

    <!-- Halaman -->
    <div class="col-md-6">
        <label class="form-label">Jumlah Halaman</label>
        <input type="number" name="JumlahHalaman" class="form-control" placeholder="Masukan Jumlah Halaman">
    </div>

    <!-- Foto Buku -->
    <div class="col-md-6">
        <label class="form-label">Foto Buku (9:16)</label>
        <input type="file" name="foto" class="form-control">
    </div>

    <!-- nama rak -->
    <div class="col-md-6">
        <label class="form-label">Nama Rak</label>
        <input type="text" name="namarak" class="form-control" placeholder="Masukan Nama Rak">
    </div>

    <!-- no rak -->
    <div class="col-md-6">
        <label class="form-label">No rak</label>
        <input type="number" name="norak" class="form-control" placeholder="Masukan No Rak">
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
        <button class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
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
