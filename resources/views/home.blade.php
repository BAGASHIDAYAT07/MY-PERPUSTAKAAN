<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Plant. – Monstera</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google Font (optional) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" />

    <style>
      :root{ --bg: #e5f0ee; --card: #ffffff; --text: #111827; --muted:#6b7280; --green:#1f7a63; }
      body{ background: radial-gradient(1200px 600px at 50% 0%, #dfeeed, #d7e7e5 40%, #cfe0de 70%, #c8dada 100%); font-family: 'Poppins', system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial, 'Noto Sans', 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; }
      .shell{ max-width:1100px; }
      .panel{ background:var(--card); border-radius:22px; box-shadow: 0 10px 30px rgba(16,24,40,.08); overflow: hidden; }

      /* Navbar */
      .navbar-brand{ font-weight:700; letter-spacing:.5px; }
      .nav-link{ color:#111827; opacity:.8; }
      .nav-link:hover{ opacity:1; }
      .nav-link.active{ position:relative; font-weight:600; opacity:1; }
      .nav-link.active::after{ content:""; position:absolute; left:6px; right:6px; bottom:4px; height:2px; background:#0f5132; border-radius:2px; }

      /* Hero */
      .hero{ position:relative; padding: 56px 56px 28px 56px; }
      .hero h1{ font-size: clamp(40px, 6vw, 68px); font-weight:800; letter-spacing:.5px; }
      .hero p{ color:var(--muted); max-width: 520px; }
      .hero .btn-cta{ background:#1f7a63; border:none; padding:.9rem 1.6rem; border-radius:999px; box-shadow:0 12px 18px rgba(31,122,99,.24); }
      .hero .btn-cta:hover{ background:#17604e; }
      .plant-wrap{ position:relative; }
      .plant{ width: 100%; max-width:520px; object-fit:cover; border-radius:14px; }

      /* Features */
      .features{ padding: 28px 40px 40px 40px; }
      .feature i{ font-size:1.4rem; }
      .feature h6{ margin:0; font-weight:600; }
      .feature p{ margin:0; color:var(--muted); font-size:.9rem; }
      .feature .icon{ width:42px; height:42px; display:grid; place-items:center; border-radius:10px; background:#f2f6f5; margin-right:12px; }

      /* Rounded container on large screens only */
      @media (min-width: 992px){
        .hero{ padding: 56px 64px 10px 64px; }
        .features{ padding: 16px 64px 40px 64px; }
      }
    </style>
  </head>
  <body>

    <main class="container shell my-5">
      <section class="panel">
        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg px-4 pt-3">
          <a class="navbar-brand" href="#">plant.</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav mx-auto gap-lg-2">
              <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Collection</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Shop</a></li>
              <li class="nav-item"><a class="nav-link" href="#">About</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
            </ul>
            <div class="d-flex align-items-center gap-3 pb-3 pb-lg-0">
              <a class="text-dark" href="#" aria-label="Search"><i class="bi bi-search"></i></a>
              <a class="text-dark" href="#" aria-label="Account"><i class="bi bi-person"></i></a>
              <a class="text-dark" href="#" aria-label="Wishlist"><i class="bi bi-heart"></i></a>
              <a class="text-dark" href="#" aria-label="Cart"><i class="bi bi-bag"></i></a>
            </div>
          </div>
        </nav>

        <!-- HERO -->
        <div class="hero">
          <div class="row align-items-center g-4 g-lg-5">
            <div class="col-lg-6 order-2 order-lg-1">
              <h1 class="mb-3">MONSTERA</h1>
              <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
              <button class="btn btn-cta btn-lg d-inline-flex align-items-center gap-2">
                Discover
                <i class="bi bi-arrow-right"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- FEATURES -->
        <div class="features">
          <div class="row row-cols-1 row-cols-md-3 g-3 g-md-4">
            <div class="col">
              <div class="d-flex align-items-start feature">
                <div class="icon"><i class="bi bi-droplet"></i></div>
                <div>
                  <h6>Feeding</h6>
                  <p>Berikan nutrisi berkala saat masa tumbuh.</p>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="d-flex align-items-start feature">
                <div class="icon"><i class="bi bi-brightness-high"></i></div>
                <div>
                  <h6>Light</h6>
                  <p>Cahaya tidak langsung yang cukup terang.</p>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="d-flex align-items-start feature">
                <div class="icon"><i class="bi bi-shovel"></i></div>
                <div>
                  <h6>Care</h6>
                  <p>Media tanam porous dan siram saat tanah kering.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>