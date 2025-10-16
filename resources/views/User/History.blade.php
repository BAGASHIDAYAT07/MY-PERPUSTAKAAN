@extends('template.appu')

@section("kontenU")
<style>
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
  .status-dipinjam {
    background-color: #198754; color: #fff;
  }
  .status-dikembalikan {
    background-color: #0dcaf0; color: #fff;
  }

  /* 🌟 Samain style detail modal kayak di halaman peminjaman */
  .modal-content {
    border-radius: 1rem !important;
    border: none !important;
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
  }

  .modal-header {
    border-bottom: none !important;
    background-color: #ffffff;
  }

  .modal-header h5 {
    font-weight: 700;
    color: #0d6efd;
  }

  .modal-body {
    padding: 1.5rem 1.25rem;
  }

  .modal-body .mb-2 {
    padding: 0.5rem 0;
    border-bottom: 1px solid #e9ecef;
    font-size: 0.95rem;
  }

  .modal-body .mb-2:last-child {
    border-bottom: none;
  }

  .modal-body img {
    border-radius: 0.75rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    transition: transform 0.25s ease;
  }

  /* .modal-body img:hover {
    transform: scale(1.05);
  } */

  .modal-footer {
    border-top: none !important;
    background-color: #ffffff;
  }

  .modal-footer .btn {
    border-radius: 0.5rem;
    font-weight: 500;
  }

  /* 📱 Responsif kayak di modal buku */
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

  <!-- 🔹 Judul Halaman -->
  <div class="d-flex align-items-center justify-content-between bg-white shadow-sm p-3 rounded mb-4">
    <div class="d-flex align-items-center">
      <i class="bi bi-clock-history text-info fs-1 me-3"></i>
      <div>
        <h3 class="fw-bold mb-0">History Peminjaman</h3>
        <small class="text-muted">Riwayat peminjaman buku oleh pengguna</small>
      </div>
    </div>
  </div>

  <!-- 🔹 Tabel Riwayat -->
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
      </div>

      <div class="table-responsive">
<table class="table table-striped table-hover align-middle mb-0 table-bordered border-secondary-subtle">
        <thead class="table-info text-center">
          <tr>
            <th>No</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody class="text-center">
          @forelse($histories as $h)
          <tr>
            <td>{{ $loop->iteration + ($histories->currentPage() - 1) * $histories->perPage() }}</td>
            <td class="text-start">
              {{ $h->buku->judul ?? '-' }}
            </td>
            <td>
        @if(in_array($h->status, ['dipinjam', 'dikembalikan']) && $h->tanggal_pinjam)
            {{ \Carbon\Carbon::parse($h->tanggal_pinjam)->translatedFormat('d F Y') }}
        @else
            <span>-</span>
        @endif
        </td>

      <td>
        @if($h->status == 'dikembalikan' && $h->tanggal_kembali)
            {{ \Carbon\Carbon::parse($h->tanggal_kembali)->translatedFormat('d F Y') }}
        @else
            <span>-</span>
        @endif
        </td>
            <td>
              @if($h->status == 'menunggu')
                <span class="status-badge status-menunggu"><i class="bi bi-clock me-1"></i> Menunggu</span>
              @elseif($h->status == 'dipinjam')
                <span class="status-badge status-dipinjam"><i class="bi bi-check2-circle me-1"></i> Dipinjam</span>
              @elseif($h->status == 'dikembalikan')
                <span class="status-badge status-dikembalikan"><i class="bi bi-arrow-return-left me-1"></i> Dikembalikan</span>
              @elseif($h->status == 'ditolak')
                <span class="status-badge status-ditolak"><i class="bi bi-x-circle me-1"></i> Ditolak</span>
              @endif
            </td>

            <!-- 🔹 Kolom Aksi -->
            <td class="text-center">
              <div class="dropdown">
                <button class="btn btn-sm btn-light border" data-bs-toggle="dropdown">
                  <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu">
                  <!-- 👁️ Detail -->
                  <li>
                    <button class="dropdown-item text-info" data-bs-toggle="modal" data-bs-target="#detailModal-{{ $h->id }}">
                      <i class="bi bi-eye me-2"></i> Detail
                    </button>
                  </li>

                  <!-- 🗑️ Hapus -->
                  <li>
                    <form action="{{ route('history.destroy', $h->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus riwayat ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="dropdown-item text-danger">
                        <i class="bi bi-trash me-2"></i> Hapus
                      </button>
                    </form>
                  </li>
                </ul>
              </div>
            </td>
          </tr>

          <!-- 🔹 Modal Detail -->
          <div class="modal fade" id="detailModal-{{ $h->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header bg-white border-0">
                  <h5 class="modal-title fw-bold text-success">
                    <i class="bi bi-journal-text me-2"></i>Detail Riwayat Peminjaman
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                  <div class="row g-3">
                    <div class="col-md-4 text-center">
                      <img src="{{ asset('storage/' . ($h->buku->foto ?? 'img/photos/default.jpeg')) }}" 
                           alt="Foto Buku" 
     class="img-fluid rounded shadow-sm"
     style="border-radius: 0.75rem; height: 320px; width: 100%; object-fit: cover;">
                    </div>
                    <div class="col-md-8">
                      <div class="mb-2"><strong>Judul Buku:</strong>{{ $h->buku->judul ?? '-' }}</div>
                      <div class="mb-2"><strong>Peminjam:</strong>{{ $h->user->name ?? '-' }}</div>
                      <div class="mb-2"><strong>Tanggal Pinjam:</strong>{{ \Carbon\Carbon::parse($h->tgl_pinjam)->translatedFormat('d F Y') }}</div>
                      <div class="mb-2"><strong>Tanggal Kembali:</strong>{{ $h->tanggal_kembali ? \Carbon\Carbon::parse($h->tanggal_kembali)->translatedFormat('d F Y') : '-' }}</div>
                      <div class="mb-2"><strong>Status:</strong>
                        @if($h->status == 'menunggu')
                          <span class="badge bg-warning text-dark">Menunggu</span>
                        @elseif($h->status == 'dipinjam')
                          <span class="badge bg-success">Dipinjam</span>
                        @elseif($h->status == 'dikembalikan')
                          <span class="badge bg-info">Dikembalikan</span>
                        @elseif($h->status == 'ditolak')
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
            <td colspan="7" class="text-muted py-3">Belum ada riwayat peminjaman</td>
          </tr>
          @endforelse
        </tbody>
</table>
      </div>

      <!-- 🔹 Pagination -->
      <div class="mt-3 d-flex justify-content-end mx-3">
        {{ $histories->links('pagination::bootstrap-5') }}
      </div>
    </div>
  </div>
</div>

<!-- 🔔 Script Pencarian -->
<script>
document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.getElementById("searchInput");
  const rows = document.querySelectorAll("table tbody tr");

  searchInput.addEventListener("keyup", function () {
    const keyword = this.value.toLowerCase();
    rows.forEach(row => {
      const text = row.innerText.toLowerCase();
      row.style.display = text.includes(keyword) ? "" : "none";
    });
  });
});
</script>
@endsection
