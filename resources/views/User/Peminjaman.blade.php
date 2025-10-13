@extends('template.appu')

@section("kontenU")
<style>
  /* 🔹 Style umum tabel dan badge status */
  .status-badge {
    display: inline-block;
    font-size: 0.75rem;
    padding: 0.25em 0.6em;
    border-radius: 4px;
    font-weight: 500;
  }
  .status-menunggu {
    background-color: #ffc107; color: #212529;
  }
  .status-ditolak {
    background-color: #dc3545; color: #fff;
  }
  .status-disetujui {
    background-color: #198754; color: #fff;
  }
  .status-dikembalikan {
    background-color: #0dcaf0; color: #fff;
  }

  /* 🔹 Style modal detail (samakan dengan modal buku) */
  .modal-body .detail-item {
    padding: .75rem 0;
    border-bottom: 1px solid #dee2e6;
    font-size: 0.95rem;
  }
  .modal-body .detail-item:last-child {
    border-bottom: none;
  }
  .modal-content {
    border-radius: 1rem !important;
  }
  .modal-header {
    border-bottom: none;
  }
  .modal-footer {
    border-top: none;
  }
  .modal-header h5 {
    font-weight: 700;
  }
  .modal-body img {
    border-radius: .75rem;
    box-shadow: 0 2px 6px rgba(0,0,0,.15);
  }
  .modal-dialog {
    transition: transform 0.3s ease;
  }
  .modal-content .badge {
    font-size: 0.85rem;
    padding: 0.4em 0.6em;
  }

  /* Responsif mirip dengan halaman buku */
  @media (max-width: 768px) {
    .modal-body .col-md-4 {
      text-align: center;
    }
    .modal-body img {
      max-width: 220px;
      margin-bottom: 1rem;
    }
  }
</style>
<div class="container-fluid px-3" style="margin-top: -25px;">

  <!-- ✅ Judul Halaman -->
  <div class="d-flex align-items-center justify-content-between bg-white shadow-sm p-3 rounded mb-4">
    <div class="d-flex align-items-center">
      <i class="bi bi-journal-check text-success fs-1 me-3"></i>
      <div>
        <h3 class="fw-bold mb-0">Daftar Peminjaman</h3>
        <small class="text-muted">Data peminjaman buku oleh pengguna</small>
      </div>
    </div>
  </div>

  <!-- ✅ Header & Aksi -->
  <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
    <h5 class="fw-semibold text-secondary mb-0">Dartar Peminjaman</h5>
  </div>

  <!-- ✅ Card Container -->
  <div class="card shadow-sm border-0">
    <div class="card-body">
      
      <!-- 🔍 Pencarian -->
      <div class="mb-3 d-flex gap-2">
        <div class="input-group input-group-sm" style="max-width: 300px;">
          <span class="input-group-text bg-white border-end-0">
            <i class="bi bi-search text-muted"></i>
          </span>
          <input type="search" id="searchInput" class="form-control border-start-0" placeholder="Cari berdasarkan buku...">
        </div>
      </div>

      <!-- ✅ Tabel Data -->
      <table class="table table-striped table-hover align-middle mb-0 table-bordered border-secondary-subtle">
  <thead class="table-success text-center">
    <tr>
      <th>No</th>
      <th>Foto Buku</th>
      <th>Nama Buku</th>
      <th>Tanggal Peminjaman</th>
      <th>Tanggal Pengembalian</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
  </thead>

  <tbody class="text-center">
  @forelse($peminjamans as $p)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>
        @if($p->buku && $p->buku->foto)
          <img src="{{ asset('storage/' . $p->buku->foto) }}" 
               class="rounded shadow-sm img-fluid" 
               alt="Sampul Buku" 
               style="max-width: 100px;">
        @else
          <span class="text-muted">Tidak ada foto</span>
        @endif
      </td>
      <td class="text-start">
        <i class="bi bi-journal-bookmark-fill text-success me-2"></i>
        {{ $p->buku->judul ?? '-' }}
      </td>
      <td>
        @if(in_array($p->status, ['dipinjam', 'dikembalikan']) && $p->tanggal_pinjam)
            {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->translatedFormat('d F Y') }}
        @else
            <span>-</span>
        @endif
        </td>

      <td>
        @if($p->status == 'dikembalikan' && $p->tanggal_kembali)
            {{ \Carbon\Carbon::parse($p->tanggal_kembali)->translatedFormat('d F Y') }}
        @else
            <span>-</span>
        @endif
        </td>


      {{-- 🔹 Kolom Status --}}
      <td>
        @if($p->status == 'menunggu')
          <span class="status-badge status-menunggu"><i class="bi bi-clock me-1"></i> Menunggu</span>
        @elseif($p->status == 'dipinjam')
          <span class="status-badge status-disetujui"><i class="bi bi-check2-circle me-1"></i> Dipinjam</span>
        @elseif($p->status == 'dikembalikan')
          <span class="status-badge status-dikembalikan"><i class="bi bi-arrow-return-left me-1"></i> Dikembalikan</span>
        @elseif($p->status == 'ditolak')
          <span class="status-badge status-ditolak"><i class="bi bi-x-circle me-1"></i> Ditolak</span>
        @endif
      </td>

      {{-- 🔹 Kolom Aksi (Dropdown Titik 3) --}}
      <td class="text-center">
        <div class="dropdown">
          <button class="btn btn-sm btn-light border" data-bs-toggle="dropdown">
            <i class="bi bi-three-dots-vertical"></i>
          </button>
          <ul class="dropdown-menu">
            <!-- Detail -->
            <li>
              <button class="dropdown-item text-info" data-bs-toggle="modal" data-bs-target="#detailPinjamModal-{{ $p->id }}">
                <i class="bi bi-eye me-2"></i> Detail
              </button>
            </li>
            <!-- Hapus -->
            <li>
              <form action="{{ route('peminjaman.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                @csrf
                @method('DELETE')
                <button class="dropdown-item text-danger" type="submit">
                  <i class="bi bi-trash me-2"></i> Hapus
                </button>
              </form>
            </li>
          </ul>
        </div>
      </td>
    </tr>

    <!-- 🔹 Modal Detail Peminjaman -->
<div class="modal fade" id="detailPinjamModal-{{ $p->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header bg-white border-0">
        <h5 class="modal-title fw-bold text-primary">
          <i class="bi bi-journal-text me-2"></i>Detail Peminjaman
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-4">
            <img src="{{ asset('storage/' . ($p->buku->foto ?? 'img/photos/default.jpeg')) }}" 
                 class="img-fluid rounded shadow-sm" 
                 alt="Foto Buku">
          </div>

          <div class="col-md-8">
            <div class="detail-item"><strong>Judul Buku:</strong><br>{{ $p->buku->judul ?? '-' }}</div>
            <div class="detail-item"><strong>Jenis Buku:</strong><br>{{ $p->buku->JenisBuku ?? '-' }}</div>
            <div class="detail-item">
              <strong>Tanggal Pinjam:</strong><br>
              @if(in_array($p->status, ['dipinjam', 'dikembalikan']) && $p->tanggal_pinjam)
                {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->translatedFormat('d F Y') }}
              @else
                -
              @endif
            </div>
            <div class="detail-item">
              <strong>Tanggal Kembali:</strong><br>
              {{ $p->tanggal_kembali ? \Carbon\Carbon::parse($p->tanggal_kembali)->translatedFormat('d F Y') : '-' }}
            </div>
            <div class="detail-item">
              <strong>Status:</strong><br>
              @if($p->status == 'menunggu')
                <span class="badge bg-warning text-dark">Menunggu</span>
              @elseif($p->status == 'dipinjam')
                <span class="badge bg-success">Dipinjam</span>
              @elseif($p->status == 'dikembalikan')
                <span class="badge bg-info">Dikembalikan</span>
              @elseif($p->status == 'ditolak')
                <span class="badge bg-danger">Ditolak</span>
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


  @empty
    <tr>
      <td colspan="7" class="text-muted py-3">Belum ada data peminjaman</td>
    </tr>
  @endforelse
</tbody>

</table>

      <!-- ✅ Pagination -->
      <div class="mt-3 d-flex justify-content-end mx-3">
        {{ $peminjamans->links('pagination::bootstrap-5') }}
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap Toast Notification -->
<div class="position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 9999; margin-top: 20px;">
  @if (session('success'))
    <div class="toast align-items-center text-bg-success border-0 show shadow" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  @endif

  @if (session('error'))
    <div class="toast align-items-center text-bg-danger border-0 show shadow" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  @endif
</div>

<!-- 🔔 Script Pencarian -->
<script>
document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.getElementById("searchInput");
  const rows = document.querySelectorAll("table tbody tr");

  function filterTable() {
    const keyword = searchInput.value.toLowerCase();

    rows.forEach(row => {
      const text = row.innerText.toLowerCase();
      row.style.display = text.includes(keyword) ? "" : "none";
    });
  }

  searchInput.addEventListener("keyup", filterTable);
});


// Tampilkan toast otomatis
  document.addEventListener('DOMContentLoaded', function () {
    const toastElList = [].slice.call(document.querySelectorAll('.toast'));
    toastElList.map(function (toastEl) {
      const toast = new bootstrap.Toast(toastEl, { delay: 4000 });
      toast.show();
    });
  });
</script>
@endsection
