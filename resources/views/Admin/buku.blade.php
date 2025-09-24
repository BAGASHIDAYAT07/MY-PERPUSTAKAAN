@extends('template.appu')

@section("kontenU")

<head>
  <meta charset="UTF-8">
  <title>Pilihan Buku</title>
  <style>
    .card {
      border: none;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      transition: transform 0.2s;
    }
    .card:hover {
      transform: translateY(-4px);
    }
    .btn-icon {
      border: none;
      background: none;
      font-size: 18px;
    }
    .btn-like .bi-heart-fill {
      color: red;
    }
    .section-title {
      margin-top: 30px;
      margin-bottom: 15px;
      font-weight: bold;
      font-size: 18px;
      border-bottom: 2px solid #ddd;
      padding-bottom: 5px;
    }
  </style>
</head>
<body class="bg-light">

<div class="container py-4">
  <h3 class="mb-4">Pilihan Buku</h3>

  <!-- Pencarian -->
  <div class="mb-4">
    <input type="text" id="searchInput" class="form-control" placeholder="Cari buku...">
  </div>

  <!-- Judul Fiksi -->
  <div class="section-title p-3 mb-2 bg-secondary text-white text-center">
    <h3>--Fiksi--</h3>
  </div>

  <!-- Section Novel -->
  <div class="section-title">Novel</div>
  <div class="row g-3" id="Novel">
    <div class="col-md-2 col-sm-4 col-6">
      <div class="card h-100">
        <img src="img/buku/buku1.jpg" class="card-img-top" alt="Sampul Buku">
        <div class="card-body text-center">
          <h6 class="card-title mb-1">Judul Buku 1</h6>
          <p class="text-muted small">Novel</p>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
          <a href="#" class="btn btn-primary btn-sm w-100 me-1">
            <i class="bi bi-book"></i> Pinjam
          </a>
          <button class="btn-icon btn-like" onclick="toggleLike(this)">
            <i class="bi bi-heart"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-3" id="Novel">
    <div class="col-md-2 col-sm-4 col-6">
      <div class="card h-100">
        <img src="img/buku/buku1.jpg" class="card-img-top" alt="Sampul Buku">
        <div class="card-body text-center">
          <h6 class="card-title mb-1">Judul Buku 2</h6>
          <p class="text-muted small">Novel</p>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
          <a href="#" class="btn btn-primary btn-sm w-100 me-1">
            <i class="bi bi-book"></i> Pinjam
          </a>
          <button class="btn-icon btn-like" onclick="toggleLike(this)">
            <i class="bi bi-heart"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Section Komik -->
  <div class="section-title">Komik</div>
  <div class="row g-3" id="Komik">
    <div class="col-md-2 col-sm-4 col-6">
      <div class="card h-100">
        <img src="img/buku/buku1.jpg" class="card-img-top" alt="Sampul Buku">
        <div class="card-body text-center">
          <h6 class="card-title mb-1">Judul Buku 2</h6>
          <p class="text-muted small">Komik</p>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
          <a href="#" class="btn btn-primary btn-sm w-100 me-1">
            <i class="bi bi-book"></i> Pinjam
          </a>
          <button class="btn-icon btn-like" onclick="toggleLike(this)">
            <i class="bi bi-heart"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Puisi -->
   <div class="section-title">Puisi</div>
  <div class="row g-3" id="Komik">
    <div class="col-md-2 col-sm-4 col-6">
      <div class="card h-100">
        <img src="img/buku/buku1.jpg" class="card-img-top" alt="Sampul Buku">
        <div class="card-body text-center">
          <h6 class="card-title mb-1">Puisi 1</h6>
          <p class="text-muted small">Puisi</p>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
          <a href="#" class="btn btn-primary btn-sm w-100 me-1">
            <i class="bi bi-book"></i> Pinjam
          </a>
          <button class="btn-icon btn-like" onclick="toggleLike(this)">
            <i class="bi bi-heart"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- cerpen -->
   <div class="section-title">Cerpen</div>
  <div class="row g-3" id="Komik">
    <div class="col-md-2 col-sm-4 col-6">
      <div class="card h-100">
        <img src="img/buku/buku1.jpg" class="card-img-top" alt="Sampul Buku">
        <div class="card-body text-center">
          <h6 class="card-title mb-1">Cerpen 1</h6>
          <p class="text-muted small">Cerpen</p>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
          <a href="#" class="btn btn-primary btn-sm w-100 me-1">
            <i class="bi bi-book"></i> Pinjam
          </a>
          <button class="btn-icon btn-like" onclick="toggleLike(this)">
            <i class="bi bi-heart"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Drama -->
   <div class="section-title">Drama</div>
  <div class="row g-3" id="Komik">
    <div class="col-md-2 col-sm-4 col-6">
      <div class="card h-100">
        <img src="img/buku/buku1.jpg" class="card-img-top" alt="Sampul Buku">
        <div class="card-body text-center">
          <h6 class="card-title mb-1">Drama 1</h6>
          <p class="text-muted small">Drama</p>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
          <a href="#" class="btn btn-primary btn-sm w-100 me-1">
            <i class="bi bi-book"></i> Pinjam
          </a>
          <button class="btn-icon btn-like" onclick="toggleLike(this)">
            <i class="bi bi-heart"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

<!-- Nonfiksi -->
  <div class="section-title p-3 mb-2 bg-secondary text-white text-center">
    <h3>--Nonfiksi--</h3>
  </div>

<!-- Biografi -->
 <div class="section-title">Biografi</div>

  <div class="col-md-2 col-sm-4 col-6">
    <div class="card h-100">
      <img src="img/buku/buku1.jpg" class="card-img-top" alt="Sampul Buku">
      <div class="card-body text-center">
        <h6 class="card-title mb-1">Biografi 1</h6>
        <p class="text-muted small">Biografi</p>
      </div>
      <div class="card-footer d-flex justify-content-between align-items-center">
        <a href="#" class="btn btn-primary btn-sm w-100 me-1">
          <i class="bi bi-book"></i> Pinjam
        </a>
        <button class="btn-icon btn-like" onclick="toggleLike(this)">
          <i class="bi bi-heart"></i>
        </button>
      </div>
    </div>
  </div>

  <!-- Ensiklopedia -->
   <div class="section-title">Ensiklopedia</div>
  <div class="row g-3" id="Komik">
    <div class="col-md-2 col-sm-4 col-6">
      <div class="card h-100">
        <img src="img/buku/buku1.jpg" class="card-img-top" alt="Sampul Buku">
        <div class="card-body text-center">
          <h6 class="card-title mb-1">Ensiklopedia 1</h6>
          <p class="text-muted small">Ensiklopedia</p>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
          <a href="#" class="btn btn-primary btn-sm w-100 me-1">
            <i class="bi bi-book"></i> Pinjam
          </a>
          <button class="btn-icon btn-like" onclick="toggleLike(this)">
            <i class="bi bi-heart"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Buku Pelajaran -->
   <div class="section-title">Buku Pelajaran</div>
  <div class="row g-3" id="Komik">
    <div class="col-md-2 col-sm-4 col-6">
      <div class="card h-100">
        <img src="img/buku/buku1.jpg" class="card-img-top" alt="Sampul Buku">
        <div class="card-body text-center">
          <h6 class="card-title mb-1">Pelajaran 1</h6>
          <p class="text-muted small">Buku Pelajaran</p>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
          <a href="#" class="btn btn-primary btn-sm w-100 me-1">
            <i class="bi bi-book"></i> Pinjam
          </a>
          <button class="btn-icon btn-like" onclick="toggleLike(this)">
            <i class="bi bi-heart"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Buku Ilmiah -->
   <div class="section-title">Buku Ilmiah</div>
  <div class="row g-3" id="Komik">
    <div class="col-md-2 col-sm-4 col-6">
      <div class="card h-100">
        <img src="img/buku/buku1.jpg" class="card-img-top" alt="Sampul Buku">
        <div class="card-body text-center">
          <h6 class="card-title mb-1">Ilmiah 1</h6>
          <p class="text-muted small">Buku Ilmiah</p>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
          <a href="#" class="btn btn-primary btn-sm w-100 me-1">
            <i class="bi bi-book"></i> Pinjam
          </a>
          <button class="btn-icon btn-like" onclick="toggleLike(this)">
            <i class="bi bi-heart"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Buku Motivasi -->
   <div class="section-title">Buku Motivasi</div>
  <div class="row g-3" id="Komik">
    <div class="col-md-2 col-sm-4 col-6">
      <div class="card h-100">
        <img src="img/buku/buku1.jpg" class="card-img-top" alt="Sampul Buku">
        <div class="card-body text-center">
          <h6 class="card-title mb-1">Motivasi 1</h6>
          <p class="text-muted small">Buku Motivasi</p>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
          <a href="#" class="btn btn-primary btn-sm w-100 me-1">
            <i class="bi bi-book"></i> Pinjam
          </a>
          <button class="btn-icon btn-like" onclick="toggleLike(this)">
            <i class="bi bi-heart"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

<script>
  // Toggle like
  function toggleLike(btn) {
    let icon = btn.querySelector("i");
    if (icon.classList.contains("bi-heart")) {
      icon.classList.remove("bi-heart");
      icon.classList.add("bi-heart-fill");
    } else {
      icon.classList.remove("bi-heart-fill");
      icon.classList.add("bi-heart");
    }
  }

  // Pencarian buku
  document.getElementById("searchInput").addEventListener("keyup", function() {
    let filter = this.value.toLowerCase();
    let cards = document.querySelectorAll(".card");
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

</body>


@endsection
