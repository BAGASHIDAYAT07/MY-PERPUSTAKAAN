@extends('template.app')

@section("konten")
<style>
  .status-badge {
    display: inline-block;
    font-size: 0.75rem;     /* ukuran teks kecil */
    padding: 0.25em 0.6em;  /* padding tipis */
    border-radius: 4px;     /* sudut agak kotak */
    font-weight: 500;       /* tebal sedang */
  }

  .status-menunggu { background-color: #ffc107; color: #212529; }
  .status-ditolak { background-color: #dc3545; color: #fff; }
  .status-disetujui { background-color: #198754; color: #fff; }

  /* Atur scroll tabel hanya untuk layar kecil */
  .table-wrapper {
    overflow-x: visible; /* default desktop: tidak scroll */
  }
  @media (max-width: 991.98px) {
    .table-wrapper {
      overflow-x: auto;   /* HP/tablet: aktifkan scroll kalau kepaksa */
    }
  }
</style>

<div class="container-fluid px-3" style="margin-top: -25px;">
  <!-- Judul Halaman -->
  <div class="d-flex align-items-center justify-content-between bg-white shadow-sm p-3 rounded mb-4">
    <div class="d-flex align-items-center">
      <i class="bi bi-people text-primary fs-1 me-3"></i>
      <div>
        <h3 class="fw-bold mb-0">Verifikasi Siswa</h3>
        <small class="text-muted">Kelola verifikasi akun Siswa baru</small>
      </div>
    </div>
  </div>

  <!-- Header Aksi -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold text-secondary mb-0">Daftar Akun Siswa</h5>
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
  <select id="searchFilter" class="form-select form-select-sm" style="max-width: 180px;">
    <option value="all">Semua</option>
    <option value="0">Nama</option>
    <option value="1">Email</option>
    <option value="2">NIS</option>
    <option value="3">Jenis Kelamin</option>
  </select>
</div>

      <!-- Table -->
      <div class="table-wrapper">
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
  @foreach ($users as $user)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td class="text-start">
        <img src="{{ $user->foto != 'default.jpeg'
            ? asset('storage/' .  $user->foto) 
            : asset('img/photos/'. $user->foto) }}" 
             class="rounded-circle me-2" width="32" height="32">
        {{ $user->name }}
      </td>
      <td>{{ $user->email }}</td>
      <td>{{ $user->NIS }}</td>
      <td>{{ $user->jenisKelamin }}</td>
      <td>
        @if ($user->veriv == 0)
          <span class="status-badge status-menunggu">
            <i class="bi bi-clock me-1"></i> Menunggu
          </span>
        @elseif ($user->veriv == 1)
          <span class="status-badge status-disetujui">
            <i class="bi bi-check2-circle me-1"></i> Disetujui
          </span>
        @endif
      </td>
      <td>
        <div class="dropdown">
          <button class="btn btn-sm btn-light border" data-bs-toggle="dropdown">
            <i class="bi bi-three-dots-vertical"></i>
          </button>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailUserModal{{ $user->id }}">
                <i class="bi bi-eye me-2"></i> Lihat Detail
              </a>
            </li>

            @if ($user->veriv == 0)
              <li>
                <form action="{{ route('verifikasi.terima', $user->id) }}" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item text-success">
                    <i class="bi bi-check2-circle me-2"></i> Setujui
                  </button>
                </form>
              </li>
              <li>
                <form action="{{ route('verifikasi.tolak', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menolak akun ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="dropdown-item text-danger">
                    <i class="bi bi-x-circle me-2"></i> Tolak
                  </button>
                </form>
              </li>
            @endif
          </ul>
        </div>
      </td>
    </tr>

    <!-- Modal Detail User -->
<div class="modal fade" id="detailUserModal{{ $user->id }}" tabindex="-1">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-person-lines-fill me-2 text-primary"></i> Detail User
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-3">
          <img src="{{ $user->foto != 'default.jpeg'
            ? asset('storage/' .  $user->foto) 
            : asset('img/photos/'. $user->foto) }}" class="rounded-circle shadow" alt="Foto User" style="width: 100px; height: 100px;">
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><b>Nama:</b> Enggal</li>
          <li class="list-group-item"><b>Email:</b> enggal.@email.com</li>
          <li class="list-group-item"><b>NIS:</b> USR002</li>
          <li class="list-group-item"><b>Jenis Kelamin:</b> Laki-laki</li>
          <li class="list-group-item"><b>Status:</b> Menunggu</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
  @endforeach
</tbody>

        </table>
      </div>
      <div class="mt-3 d-flex justify-content-end mx-3">
       {{ $users->links('pagination::bootstrap-5') }}
      </div>
    </div>
  </div>
</div>

<script>
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
        if (cells[colIndex] && cells[colIndex].innerText.toLowerCase().includes(input)) {
          match = true;
        }
      }

      row.style.display = match ? "" : "none";
    });
  }
</script>
@endsection
