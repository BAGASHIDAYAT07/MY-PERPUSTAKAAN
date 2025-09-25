@extends('template.appu')

@section("kontenU")
<div class="container py-5">


  <div class="text-center mb-5">
    <h1 class="fw-bold display-5 text-primary">⭐ Halaman Favorit</h1>
    <p class="text-muted fs-5">Daftar item yang kamu tandai sebagai favorit</p>
  </div>


  <div class="row g-4">
 
    <div class="col-md-4">
      <div class="card shadow-lg border-0 rounded-4 h-100 card-hover">
        <img src="https://via.placeholder.com/400x250" class="card-img-top rounded-top-4" alt="Item Favorit 1">
        <div class="card-body text-center">
          <h5 class="card-title fw-bold">Item Favorit 1</h5>
          <p class="card-text text-muted">Deskripsi singkat item favorit pertama.</p>
          <a href="#" class="btn btn-outline-primary rounded-pill px-4">Lihat Detail</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-lg border-0 rounded-4 h-100 card-hover">
        <img src="https://via.placeholder.com/400x250" class="card-img-top rounded-top-4" alt="Item Favorit 2">
        <div class="card-body text-center">
          <h5 class="card-title fw-bold">Item Favorit 2</h5>
          <p class="card-text text-muted">Deskripsi singkat item favorit kedua.</p>
          <a href="#" class="btn btn-outline-primary rounded-pill px-4">Lihat Detail</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-lg border-0 rounded-4 h-100 card-hover">
        <img src="https://via.placeholder.com/400x250" class="card-img-top rounded-top-4" alt="Item Favorit 3">
        <div class="card-body text-center">
          <h5 class="card-title fw-bold">Item Favorit 3</h5>
          <p class="card-text text-muted">Deskripsi singkat item favorit ketiga.</p>
          <a href="#" class="btn btn-outline-primary rounded-pill px-4">Lihat Detail</a>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .card-hover {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .card-hover:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
  }
</style>
@endsection
