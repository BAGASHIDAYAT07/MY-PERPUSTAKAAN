@extends('template.appu')

@section("kontenU")
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

  <!-- Card Grid -->
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <div class="row g-3" id="bukuGrid">
        @foreach ($buku as $item) 
  <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
    <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
      
      <!-- Cover Buku -->
      <div class="position-relative">
        <img src="{{ asset('storage/' . $item->foto) }}" class="card-img-top" alt="Sampul Buku">

        <!-- Badge Kategori -->
        <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2">
          {{ $item->JenisBuku }}
        </span>

        <!-- Status -->
        @if($item->status == 'dipinjam')
          <span class="badge bg-danger position-absolute top-0 end-0 m-2">
            Dipinjam
          </span>
        @endif
      </div>

      <!-- Body -->
      <div class="card-body text-center">
        <h6 class="card-title fw-semibold mb-1 text-truncate">
          {{ $item->judul }}
        </h6>
        <small class="text-muted d-block mb-2">
          {{ $item->Pencipta ?? 'Anonim' }}
        </small>
      </div>

      <!-- Footer -->
      <div class="card-footer bg-white border-0">
  <div class="d-flex justify-content-center gap-2">
    <!-- Tombol Detail -->
    <a href="#" 
       class="btn btn-success btn-sm flex-fill"
       data-bs-toggle="modal" 
       data-bs-target="#detailBukuModal-{{ $item->id }}">
      <i class="bi bi-eye"></i> Detail
    </a>

    <!-- Tombol Pinjam -->
    @if($item->status == 'dipinjam')
      <button class="btn btn-outline-secondary btn-sm flex-fill" disabled>
        Tidak Tersedia
      </button>
    @else
      <a href="#" class="btn btn-primary btn-sm flex-fill">
        <i class="bi bi-book"></i> Pinjam
      </a>
    @endif
  </div>
</div>

    </div>
  </div>

  <!-- ✅ Modal Detail Buku -->
  <div class="modal fade" id="detailBukuModal-{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title fw-bold">
            <i class="bi bi-journal-text me-2"></i> Detail Buku
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="row">
            <!-- Foto Buku -->
            <div class="col-md-4 text-center mb-1">
              <img src="{{ asset('storage/' . $item->foto) }}" 
                   class="rounded shadow img-fluid" 
                   alt="Foto Buku" 
                   style="width: 550px; object-fit: cover;">
            </div>

            <!-- Detail Buku -->
            <div class="col-md-8">
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Judul Buku:</b> {{ $item->judul }}</li>
                <li class="list-group-item"><b>Deskripsi:</b> {{ $item->deskripsi }}</li>
                <li class="list-group-item"><b>Jenis:</b> {{ $item->JenisBuku }}</li>
                <li class="list-group-item"><b>Penerbit:</b> {{ $item->Penerbit }}</li>
                <li class="list-group-item"><b>Pencipta:</b> {{ $item->Pencipta }}</li>
                <li class="list-group-item"><b>Kota:</b> {{ $item->TempatTerbit }}</li>
                <li class="list-group-item"><b>Tahun:</b> {{ $item->TahunTerbit }}</li>
                <li class="list-group-item"><b>Halaman:</b> {{ $item->JumlahHalaman }}</li>
                <li class="list-group-item"><b>Rak:</b> {{ $item->namarak ?? '-' }} / {{ $item->norak ?? '-' }}</li>
                <li class="list-group-item">
                  <b>Status:</b> 
                  @if ($item->status == 'dipinjam')
                    <span class="badge bg-danger">Dipinjam</span>
                  @else
                    <span class="badge bg-success">Tersedia</span>
                  @endif
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-danger" data-bs-dismiss="modal">
            <i class="bi bi-x-circle"></i> Tutup
          </button>
        </div>
      </div>
    </div>
  </div>
@endforeach



      </div>
    </div>
  </div>
</div>

<!-- Script -->
<script>
  // ✅ Toggle Like
  function toggleLike(btn) {
    let icon = btn.querySelector("i");
    if (icon.classList.contains("bi-heart")) {
      icon.classList.remove("bi-heart");
      icon.classList.add("bi-heart-fill");
      btn.classList.add("text-danger");
    } else {
      icon.classList.remove("bi-heart-fill");
      icon.classList.add("bi-heart");
      btn.classList.remove("text-danger");
    }
  }

  // ✅ Search filter untuk card buku
  document.getElementById("searchInput").addEventListener("keyup", function() {
    let filter = this.value.toLowerCase();
    let cards = document.querySelectorAll("#bukuGrid .card");
    cards.forEach(function(card) {
      let title = card.querySelector(".card-title").textContent.toLowerCase();
      if (title.indexOf(filter) > -1) {
        card.parentElement.style.display = "";
      } else {
        card.parentElement.style.display = "none";
      }
    });
  });
</script>
@endsection
