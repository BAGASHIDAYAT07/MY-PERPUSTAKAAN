@extends('template.appu')

@section("kontenU")
<style>
  /* Custom col for 5 per row in large screen */
  @media (min-width: 992px) {
    .col-lg-5ths {
      width: 20%;
      flex: 0 0 auto;
    }
  }

  /* Card styling */
  .book-card {
    transition: transform 0.3s ease;
    height: 100%;
    max-width: 260px; /* lebih besar dari sebelumnya */
    margin: 0 auto;
  }

  .book-card:hover img {
    transform: scale(1.03);
  }

  .book-card img {
    height: 350px; /* lebih tinggi untuk gambar */
    object-fit: cover;
    transition: transform 0.3s ease;
  }

  .book-card .card-body {
    padding: 0.75rem;
  }

  /* Perkecil jarak antar card */
  .row.tight-gutter {
    margin-left: -6px;
    margin-right: -6px;
  }

  .row.tight-gutter > [class*='col-'] {
    padding-left: 6px;
    padding-right: 6px;
  }

  .modal-body .detail-item {
    padding: .75rem 0;
    border-bottom: 1px solid #dee2e6;
  }

  .modal-body .detail-item:last-child {
    border-bottom: none;
  }

  @media (max-width: 768px) {
    .book-card {
      max-width: 100%;
    }
  }
</style>


<div class="container-fluid px-3" style="margin-top: -25px;">

  <!-- Judul Halaman -->
  <div class="d-flex align-items-center justify-content-between bg-white shadow-sm p-3 rounded mb-4">
    <div class="d-flex align-items-center">
      <i class="bi bi-book-half text-primary fs-1 me-3"></i>
      <div>
        <h3 class="fw-bold mb-0">Pilihan Buku</h3>
        <small class="text-muted">Koleksi buku yang tersedia untuk dipinjam</small>
      </div>
    </div>
  </div>

  <!-- Header Aksi -->
  <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
    <h5 class="fw-semibold text-secondary mb-0">Daftar Buku</h5>
    <div class="input-group input-group-sm" style="max-width: 300px;">
      <span class="input-group-text bg-white border-end-0">
        <i class="bi bi-search text-muted"></i>
      </span>
      <input type="search" id="searchInput" class="form-control border-start-0 p-2" placeholder="Cari buku...">
    </div>
  </div>

  <!-- Grid Buku -->
  <div class="row tight-gutter g-3" id="bukuGrid">
    @foreach ($buku as $item)
    <div class="col-6 col-md-3 col-lg-4ths d-flex">
      <div class="card shadow-sm border-0 overflow-hidden book-card rounded-3 w-100">

        <!-- Gambar Buku -->
        <div class="position-relative">
          <img src="{{ asset('storage/' . $item->foto) }}" class="card-img-top" alt="Sampul Buku">
          <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2">
            {{ $item->JenisBuku }}
          </span>
          @if($item->status_pinjam == 'dipinjam')
          <span class="badge bg-danger position-absolute top-0 end-0 m-2">Dipinjam</span>
          @endif
        </div>

        <!-- Info Buku -->
        <div class="card-body text-center">
          <h6 class="fw-bold mb-1 text-truncate">{{ $item->judul }}</h6>
          <p class="text-muted small mb-2 text-truncate">{{ $item->Pencipta ?? 'Anonim' }}</p>
          <button class="btn btn-outline-success btn-sm w-100" data-bs-toggle="modal"
            data-bs-target="#detailBukuModal-{{ $item->id }}">
            <i class="bi bi-eye"></i> Detail
          </button>
        </div>
      </div>
    </div>

    <!-- Modal Detail Buku -->
    <div class="modal fade" id="detailBukuModal-{{ $item->id }}" tabindex="-1" aria-hidden="true">
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
              <div class="col-md-4">
                <img src="{{ asset('storage/' . $item->foto) }}" class="img-fluid rounded shadow-sm" alt="Foto Buku">
              </div>
              <div class="col-md-8">
                <div class="detail-item"><strong>Judul Buku:</strong><br>{{ $item->judul }}</div>
                <div class="detail-item"><strong>Deskripsi:</strong><br>{{ $item->deskripsi }}</div>
                <div class="detail-item"><strong>Jenis:</strong><br>{{ $item->JenisBuku }}</div>
                <div class="detail-item"><strong>Penerbit:</strong><br>{{ $item->Penerbit }}</div>
                <div class="detail-item"><strong>Pencipta:</strong><br>{{ $item->Pencipta }}</div>
                <div class="detail-item"><strong>Kota:</strong><br>{{ $item->TempatTerbit }}</div>
                <div class="detail-item"><strong>Tahun:</strong><br>{{ $item->TahunTerbit }}</div>
                <div class="detail-item"><strong>Halaman:</strong><br>{{ $item->JumlahHalaman }}</div>
                <div class="detail-item"><strong>Rak:</strong><br>{{ $item->namarak ?? '-' }} / {{ $item->norak ?? '-' }}</div>
                <div class="detail-item"><strong>Status:</strong><br>
                  @if ($item->status_pinjam == 'dipinjam')
                    <span class="badge bg-danger">Dipinjam</span>
                  @else
                    <span class="badge bg-success">Tersedia</span>
                  @endif
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer border-0">
            <button type="button" class="btn btn-danger border" data-bs-dismiss="modal">
              <i class="bi bi-x-circle"></i> Tutup
            </button>

            @if ($item->status_pinjam == 'dipinjam')
              <!-- Jika buku sedang dipinjam -->
              <button class="btn btn-secondary" disabled>
                <i class="bi bi-hourglass-split"></i> Sedang Dipinjam
              </button>
            @else
              <!-- Jika buku tersedia -->
              <form action="{{ route('pinjam.buku', $item->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success">
                  <i class="bi bi-book"></i> Pinjam Buku
                </button>
              </form>
            @endif
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

<!-- Script -->
<script>
  // Filter pencarian buku
  document.getElementById("searchInput").addEventListener("keyup", function () {
    let filter = this.value.toLowerCase();
    let cards = document.querySelectorAll("#bukuGrid .card");
    cards.forEach(function (card) {
      let title = card.querySelector(".fw-bold").textContent.toLowerCase();
      card.parentElement.style.display = title.includes(filter) ? "" : "none";
    });
  });
</script>
@endsection
