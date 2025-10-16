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

  /* Responsif untuk ukuran tablet (max-width: 768px) */
  @media (max-width: 768px) {
    .modal-body .col-md-4 {
      text-align: center;
    }
    .modal-body img {
      max-width: 220px;
      margin-bottom: 1rem;
    }
  }

  /* ✅ Responsif untuk ukuran ponsel (max-width: 576px) */
  @media (max-width: 576px) {
    /* 🔹 Container dan padding */
    .container-fluid {
      padding: 0 10px;
      margin-top: -10px;
    }

    /* 🔹 Judul halaman */
    .d-flex.align-items-center.justify-content-between {
      flex-direction: column;
      text-align: center;
      padding: 0.75rem;
    }
    .d-flex.align-items-center i.bi-journal-check {
      font-size: 1.25rem;
    }
    h3.fw-bold {
      font-size: 1.1rem;
    }
    small.text-muted {
      font-size: 0.75rem;
    }

    /* 🔹 Header & aksi */
    .d-flex.flex-wrap.justify-content-between {
      flex-direction: column;
      gap: 0.75rem;
      text-align: left;
    }
    .d-flex.flex-wrap.justify-content-between h5.fw-semibold {
  text-align: left !important;
  width: 100%;
  display: block;
}
    h5.fw-semibold {
      font-size: 0.9rem;
      text-align: left !important;
    }

    /* 🔹 Pencarian */
    .input-group.input-group-sm {
      max-width: 100%;
      width: 100%;
    }
    .input-group-text, .form-control {
      font-size: 0.8rem;
      padding: 0.25rem 0.5rem;
    }

    /* ✅ Tabel tetap tabel (bisa di-scroll horizontal) */
    .table-responsive {
      width: 100%;
        overflow: visible !important;
      -webkit-overflow-scrolling: touch;
      border-radius: 0.5rem;
    }
    table.table {
      width: 100%;
      min-width: 650px; /* biar struktur tabel gak rusak */
      border-collapse: collapse;
    }
    .table th,
    .table td {
      white-space: nowrap;
      vertical-align: middle;
      font-size: 0.85rem;
    }
    .table td img {
      width: 70px;
      height: 100px;
      object-fit: cover;
      border-radius: 0.4rem;
    }

    /* 🔹 Dropdown & tombol kecil */
    .btn,
    .dropdown-menu {
      font-size: 0.8rem;
    }
    /* 🔹 Modal responsif */
    .modal-dialog {
      margin: 0.25rem;
    }
    .modal-body img {
      max-width: 120px;
      height: 160px;
      margin: 0 auto 0.75rem;
    }
    .modal-body .col-md-4, .modal-body .col-md-8 {
      width: 100%;
      text-align: center;
    }
    .modal-body .detail-item {
      font-size: 0.8rem;
      padding: 0.25rem 0;
    }
    .modal-header h5 {
      font-size: 1.1rem;
    }
    .modal-footer button {
      font-size: 0.8rem;
      padding: 0.25rem 0.75rem;
    }

    /* 🔹 Toast notifikasi */
    .position-fixed.top-0.start-50 {
      top: 5px;
      width: 90%;
      margin: 0 auto;
    }
    .toast {
      font-size: 0.75rem;
    }
    .toast-body {
      padding: 0.25rem;
    }
    .btn-close {
      font-size: 0.7rem;
    }

    /* 🔹 Pagination */
    .pagination {
      font-size: 0.7rem;
    }
    .page-link {
      padding: 0.2rem 0.4rem;
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
    <h5 class="fw-semibold text-secondary mb-0">Daftar Peminjaman</h5>
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
       <div class="table-responsive">
      <table class="table table-striped table-hover align-middle mb-0 table-bordered border-secondary-subtle">
        <thead class="table-success text-center">
          <tr>
            <th>No</th>
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
              <td data-label="No">{{ $loop->iteration }}</td>
              <td data-label="Nama Buku" class="text-start">
                {{ $p->buku->judul ?? '-' }}
              </td>
              <td data-label="Tanggal Peminjaman">
                @if(in_array($p->status, ['dipinjam', 'dikembalikan']) && $p->tanggal_pinjam)
                  {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->translatedFormat('d F Y') }}
                @else
                  <span>-</span>
                @endif
              </td>
              <td data-label="Tanggal Pengembalian">
                @if($p->status == 'dikembalikan' && $p->tanggal_kembali)
                  {{ \Carbon\Carbon::parse($p->tanggal_kembali)->translatedFormat('d F Y') }}
                @else
                  <span>-</span>
                @endif
              </td>
              <td data-label="Status">
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
              <td data-label="Aksi" class="text-center">
                <div class="dropdown style="">
                  <button class="btn btn-sm btn-light border" data-bs-toggle="dropdown">
                    <i class="bi bi-three-dots-vertical"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <button class="dropdown-item text-info" data-bs-toggle="modal" data-bs-target="#detailPinjamModal-{{ $p->id }}">
                        <i class="bi bi-eye me-2"></i> Detail
                      </button>
                    </li>
                    @if($p->status == 'menunggu')
                      <li>
                        <form action="{{ route('peminjaman.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                          @csrf
                          @method('DELETE')
                          <button class="dropdown-item text-danger" type="submit">
                            <i class="bi bi-trash me-2"></i> Hapus
                          </button>
                        </form>
                      </li>
                    @endif
                  </ul>
                </div>
              </td>
            </tr>

            <!-- 🔹 Modal Detail Peminjaman -->
            <div class="modal fade" id="detailPinjamModal-{{ $p->id }}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
                <div class="modal-content border-0 shadow-lg rounded-4">
                  <div class="modal-header bg-white border-0">
                    <h5 class="modal-title fw-bold text-success">
                      <i class="bi bi-journal-text me-2"></i>Detail Peminjaman
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row g-3">
                      <div class="col-md-4">
                        <img src="{{ asset('storage/' . ($p->buku->foto ?? 'img/photos/default.jpeg')) }}" 
                             alt="Foto Buku" 
                             class="img-fluid rounded shadow-sm"
                             style="border-radius: 0.75rem; height: 320px; width: 100%; object-fit: cover;">
                      </div>
                      <div class="col-md-8">
                        <div class="detail-item"><strong>Judul Buku:</strong> {{ $p->buku->judul ?? '-' }}</div>
                        <div class="detail-item"><strong>Jenis Buku:</strong> {{ $p->buku->JenisBuku ?? '-' }}</div>
                        <div class="detail-item">
                          <strong>Tanggal Pinjam:</strong>
                          @if(in_array($p->status, ['dipinjam', 'dikembalikan']) && $p->tanggal_pinjam)
                            {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->translatedFormat('d F Y') }}
                          @else
                            -
                          @endif
                        </div>
                        <div class="detail-item">
                          <strong>Tanggal Kembali:</strong>
                          {{ $p->tanggal_kembali ? \Carbon\Carbon::parse($p->tanggal_kembali)->translatedFormat('d F Y') : '-' }}
                        </div>
                        <div class="detail-item">
                          <strong>Status:</strong>
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
      </div>

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
  document.getElementById("searchInput").addEventListener("keyup", filterTable);

  function filterTable() {
    let input = document.getElementById("searchInput").value.toLowerCase();
    let rows = document.querySelectorAll("table tbody tr");

    rows.forEach(function (row) {
      let text = row.innerText.toLowerCase();
      row.style.display = text.includes(input) ? "" : "none";
    });
  }

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