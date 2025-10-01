<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <title>Beranda - MY-PERPUSTAKAAN</title>

    <!-- Styles -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css"
      rel="stylesheet"
    />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />

    <!-- Chart.js -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
      crossorigin="anonymous"
    ></script>

    <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
      body {
        background-color: #f5f9fc;
        margin: 0;
        padding: 0;
        font-family: "Poppins", sans-serif;
      }

      /* Fixed Navbar */
      .navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 70px;
        z-index: 1000; /* lebih rendah dari sidebar */
        border-radius: 0;
        width: 100%;
      }

      /* Fix posisi dropdown user */
      .navbar .nav-item.dropdown {
        position: relative;
      }

      .navbar .dropdown-menu {
        position: absolute;
        top: 100% !important;
        right: 0;
        left: auto;
        margin-top: 0.5rem;
      }

      /* Sidebar */
      #sidebar {
        position: fixed;
        top: 0; /* mulai dari atas biar nutup navbar */
        left: 0;
        width: 240px;
        height: 100vh;
        background-color: #fff;
        z-index: 1050; /* lebih tinggi dari navbar */
        padding: 20px 15px;
      }

      #sidebar.hide {
        transform: translateX(-250px); /* kalau disembunyikan */
      }

      #sidebar::-webkit-scrollbar {
        display: none;
      }

      #sidebar .nav-link {
        color: #fff;
        font-weight: 500;
        margin: 5px 0;
        display: flex;
        align-items: center;
        gap: 8px;
      }

      /* Hover sidebar */
      #sidebar .nav-link {
        color: #212529; /* default teks hitam */
        transition: all 0.2s ease;
      }

      #sidebar .nav-link:hover {
        background-color: #d1e7dd; /* hijau muda */
        color: #0f5132; /* hijau tua */
        border-radius: 8px;
      }

      /* Main Content */
      #main-content {
        margin-left: 215px; /* default geser karena sidebar tampil */
        transition: margin-left 0.3s ease-in-out;
      }

      /* Mobile view */
      @media (max-width: 767.98px) {
      #sidebar {
        transform: translateX(-250px); /* default sembunyi */
      }

      #sidebar.show {
        transform: translateX(0); /* tampil saat burger dipencet */
      }

      #main-content {
        margin-left: 0 !important; /* konten full di mobile */
      }

      /* Sembunyikan logo, tulisan judul, dan username di mobile */
      .logo-nav,
      .brand-text,
      .username-text {
        display: none !important;
      }
    }

      .dropdown-menu {
        padding: 8px 0;
        font-size: 15px;
      }

      .dropdown-item {
        transition: background 0.2s ease, color 0.2s ease;
        border-radius: 6px;
      }

      .dropdown-item:hover {
        background-color: #e6f4ea;
        color: #2e7d32;
      }
    </style>
  </head>

  <body>
    <!-- Navbar -->
<nav class="navbar navbar-expand bg-white shadow-sm px-2"
     style="height: 70px; position: fixed; top: 0; left: 240px; right: 0; width: calc(100% - 240px);">
  <div class="container-fluid d-flex justify-content-between align-items-center">

    <!-- Kiri: Judul Halaman -->
    <div>
      <h5 class="mb-0 text-dark" style="font-weight: 600;">Dashboard</h5>
      <small class="text-success">Dashboard</small>
    </div>

    <!-- Kanan: Notifikasi + User -->
    <div class="d-flex align-items-center">
      <!-- Ikon Notifikasi -->
      <a href="#" class="text-dark me-4">
        <i class="bi bi-bell fs-5"></i>
      </a>

      <!-- User Dropdown -->
      <div class="dropdown">
        <a class="d-flex align-items-center text-decoration-none" 
           href="#" 
           id="userDropdown" 
           role="button" 
           data-bs-toggle="dropdown" 
           aria-expanded="false">
          
          <!-- Nama + Role -->
          <div class="text-end me-2">
            <div class="fw-semibold text-dark">BangNino</div>
            <small class="text-muted">User</small>
          </div>

          <!-- Foto Admin -->
          <img src="../img/photos/user.jpg"
               alt="User"
               class="rounded-circle"
               style="width: 38px; height: 38px; object-fit: cover; cursor: pointer;">
        </a>

        <!-- Menu Dropdown -->
        <ul class="dropdown-menu dropdown-menu-end shadow rounded-3 border-0" 
            aria-labelledby="userDropdown" 
            style="min-width: 200px;">
          
          <li>
            <a class="dropdown-item d-flex align-items-center gap-2 py-2" 
               href="#" 
               data-bs-toggle="modal" 
               data-bs-target="#pengaturanModal">
              <i class="bi bi-gear text-success"></i> Pengaturan
            </a>
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#!">
              <i class="bi bi-clock-history text-success"></i> Riwayat Aktivitas
            </a>
          </li>

          <li><hr class="dropdown-divider" /></li>

          <li>
            <a class="dropdown-item d-flex align-items-center gap-2 py-2 fw-bold text-success" href="/logout">
              <i class="bi bi-box-arrow-right"></i> Keluar
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>




    <!-- Sidebar -->
<div id="sidebar" class="d-flex flex-column shadow-sm" 
     style="width: 240px; height: 100vh; background-color: #fff; position: fixed; top: 0; left: 0; padding: 20px 15px; overflow-y: auto;">

  <!-- Logo + Judul -->
  <div class="text-center mb-4">
    <img src="../img/logo/smk.png" alt="Logo" style="width: 60px;">
    <h5 class="mt-4 fw-bold text-success" style="font-size: 19px;">MY PERPUSTAKAAN</h5>
    <p class="text-muted small font" style="font-size: 12px; font-weight: 500;">Sistem Informasi Perpustakaan</p>
  </div>


  <!-- Menu -->
  <nav class="nav flex-column flex-grow-1">

        <a class="nav-link d-flex align-items-center mb-2 fw-semibold rounded py-2 px-3 {{ $active == 'buku'  ? 'bg-success text-white' : 'text-muted' }}" href="/buku">
          <i class="bi bi-journal-bookmark-fill me-2"></i> Buku
        </a>

        <a class="nav-link d-flex align-items-center mb-2 fw-semibold rounded py-2 px-3 {{ $active == 'Favorit' ? 'bg-success text-white' : 'text-muted' }}" href="/Favorit">
          <i class="bi bi-heart me-2"></i> Favorit
        </a>

        <a class="nav-link d-flex align-items-center mb-2 fw-semibold rounded py-2 px-3 {{ $active == 'Peminjaman' ? 'bg-success text-white' : 'text-muted' }}" href="/Peminjaman">
          <i class="bi bi-journal-arrow-down me-2"></i> Peminjaman
        </a>

        <a class="nav-link d-flex align-items-center mb-2 fw-semibold rounded py-2 px-3 {{ $active == 'History' ? 'bg-success text-white' : 'text-muted' }}" href="/History">
          <i class="bi bi-clock-history me-2"></i> History
        </a>

        <a class="nav-link d-flex align-items-center mb-2 fw-semibold rounded py-2 px-3" href="/help">
          <i class="bi bi-question-circle me-2"></i> Help
        </a>
  </nav>
</div>

<!-- Main Content -->
<div id="main-content" style="padding-left: 25px; padding-top:107px;">
  <main id="app-content">@yield("kontenU")</main>
</div>


    <!-- Modal Pengaturan -->
    <div
      class="modal fade"
      id="pengaturanModal"
      tabindex="-1"
      aria-labelledby="pengaturanModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
          <div class="modal-header bg-success text-white rounded-top-4">
            <h5 class="modal-title fw-bold" id="pengaturanModalLabel">
              <i class="bi bi-gear me-2"></i> Pengaturan Profil
            </h5>
            <button
              type="button"
              class="btn-close btn-close-white"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body p-4">
            <form>
              <!-- Upload Foto Profil -->
              <div class="mb-4 text-center">
                <img
                  id="previewFoto"
                  src="../img/photos/user.jpg"
                  alt="Foto Profil"
                  class="rounded-circle mb-3"
                  style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #3b8763;"
                />
                <div>
                  <input
                    type="file"
                    class="form-control d-inline-block"
                    style="max-width: 300px;"
                    accept="image/*"
                    onchange="previewImage(event)"
                  />
                </div>
              </div>

              <!-- Nama Lengkap -->
              <div class="mb-3">
                <label class="form-label fw-semibold">Nama Lengkap</label>
                <input type="text" class="form-control" value="Admin" />
              </div>

              <!-- Email -->
              <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input
                  type="email"
                  class="form-control"
                  value="admin@contoh.com"
                />
              </div>

              <!-- Password -->
              <div class="mb-3">
                <label class="form-label fw-semibold">Password Baru</label>
                <input
                  type="password"
                  class="form-control"
                  placeholder="••••••••"
                />
              </div>
            </form>
          </div>
          <div class="modal-footer border-0">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Batal
            </button>
            <button type="button" class="btn btn-success">
              Simpan Perubahan
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>

    <script>
      const sidebar = document.getElementById("sidebar");
      const toggleBtn = document.getElementById("sidebarToggle");
      const mainContent = document.getElementById("main-content");

      if (toggleBtn) {
      toggleBtn.addEventListener("click", () => {
        if (window.innerWidth > 768) {
          // Desktop toggle
          sidebar.classList.toggle("hide");
          mainContent.style.marginLeft = sidebar.classList.contains("hide")
            ? "0"
            : "215px";
        } else {
          // Mobile toggle pakai .show
          sidebar.classList.toggle("show");
        }
      });
    }

      // Preview Foto Profil
      function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById("previewFoto");
        if (input.files && input.files[0]) {
          const reader = new FileReader();
          reader.onload = function (e) {
            preview.src = e.target.result;
          };
          reader.readAsDataURL(input.files[0]);
        }
      }
    </script>
  </body>
</html>
