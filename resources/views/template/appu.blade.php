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

      /* Navbar */
      .navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 70px;
        z-index: 1100; /* Lebih tinggi dari sidebar */
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 0 15px;
        display: flex;
        align-items: center;
        justify-content: space-between;
      }

      .navbar .mobile-toggle {
        display: none;
        background: none;
        border: none;
        font-size: 1.5rem;
        color: #198754;
        cursor: pointer;
      }

      /* Sidebar */
      #sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 240px;
        height: 100vh;
        background-color: #fff;
        z-index: 1000; /* Lebih rendah dari navbar */
        padding: 20px 15px;
        transition: transform 0.3s ease;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
      }

      #sidebar.hide {
        transform: translateX(-250px);
      }

      #sidebar.show {
        transform: translateX(0);
      }

      #sidebar .nav-link {
        color: #212529;
        font-weight: 500;
        margin: 5px 0;
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 15px;
        border-radius: 8px;
        text-decoration: none;
      }

      #sidebar .nav-link:hover {
        background-color: #d1e7dd;
        color: #0f5132;
      }

      #sidebar .nav-link.active {
        background-color: #198754;
        color: #fff;
      }

      /* Main Content */
      #main-content {
        margin-left: 240px;
        margin-top: 20px;
        padding: 90px 15px 15px; /* Padding atas untuk ruang navbar */
        transition: margin-left 0.3s ease;
      }

      /* Dropdown */
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

      .merah {
        color: #DC3545;
        font-weight: 500;
        transition: background 0.2s ease, color 0.2s ease;
      }

      .merah:hover {
        background-color: #DC3545;
        color: #ffffff;
      }

      /* Media Queries */
      @media (max-width: 767.98px) {
        #sidebar {
          transform: translateX(-250px);
        }

        #sidebar.show {
          transform: translateX(0);
        }

        .navbar .mobile-toggle {
          display: block;
        }

        .navbar .title-section {
          display: none;
        }

        #main-content {
          margin-left: 0;
          padding: 80px 15px 15px;
        }
      }

      @media (min-width: 768px) and (max-width: 991.98px) {
        #sidebar {
          width: 200px;
        }

        #main-content {
          margin-left: 200px;
        }
      }

      @media (min-width: 992px) {
        #sidebar {
          width: 240px;
        }

        #main-content {
          margin-left: 240px;
        }
      }
    </style>
  </head>

  <body>
    <!-- Navbar -->
    <nav class="navbar" style="z-index: 1">
      <button class="mobile-toggle" id="sidebarToggle">
        <i class="bi bi-list"></i>
      </button>
      <div class="title-section">
        <h5 class="mb-0 text-dark" style="font-weight: 600;">Dashboard</h5>
        <small class="text-success">Dashboard</small>
      </div>

      <!-- User Dropdown -->
      <div class="dropdown">
        <a class="d-flex align-items-center text-decoration-none" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="text-end me-2 username-text">
            <div class="fw-semibold text-dark">{{ Auth::user()->name }}</div>
            <small class="text-muted">{{ Auth::user()->role }}</small>
          </div>
          <img src="{{ Auth::user()->foto != 'default.jpeg' ? asset('storage/' . Auth::user()->foto) : asset('img/photos/'. Auth::user()->foto) }}"
               alt="{{ Auth::user()->name }}"
               class="rounded-circle"
               style="width: 38px; height: 38px; object-fit: cover; cursor: pointer; margin-right: 10px;">
        </a>
        <ul class="dropdown-menu dropdown-menu-end shadow rounded-3 border-0" aria-labelledby="userDropdown" style="min-width: 180px;">
          <li>
            <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#" data-bs-toggle="modal" data-bs-target="#pengaturanModal">
              <i class="bi bi-gear text-success"></i> Pengaturan
            </a>
          </li>
          <li>
            <a class="merah d-flex align-items-center gap-2 py-2 fw-bold" style="padding-left: 17px; text-decoration: none;" href="/logout">
              <i class="bi bi-box-arrow-right"></i> Keluar
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Sidebar -->
    <div id="sidebar" class="d-flex flex-column shadow-sm">
      <div class="text-center mb-4">
        <img src="../img/logo/smk.png" alt="Logo" style="width: 60px;">
        <h5 class="mt-4 fw-bold text-success" style="font-size: 19px;">MY PERPUSTAKAAN</h5>
        <p class="text-muted small" style="font-size: 12px; font-weight: 500;">Sistem Informasi Perpustakaan</p>
      </div>
      <nav class="nav flex-column flex-grow-1">
        <a class="nav-link {{ $active == 'buku' ? 'active' : '' }}" href="/buku">
          <i class="bi bi-journal-bookmark-fill me-2"></i> Buku
        </a>
        <a class="nav-link {{ $active == 'Peminjaman' ? 'active' : '' }}" href="/pinjaman">
          <i class="bi bi-journal-arrow-down me-2"></i> Peminjaman
        </a>
        <a class="nav-link {{ $active == 'History' ? 'active' : '' }}" href="/History">
          <i class="bi bi-clock-history me-2"></i> History
        </a>
      </nav>
    </div>

    <!-- Main Content -->
    <div id="main-content">
      <main id="app-content">@yield("kontenU")</main>
    </div>

    <!-- Modal Pengaturan -->
    <div class="modal fade" id="pengaturanModal" tabindex="-1" aria-labelledby="pengaturanModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4">
          <div class="modal-header text-white rounded-top-4 bg-success">
            <h5 class="modal-title text-white fw-bold" id="pengaturanModalLabel"><i class="bi bi-gear me-2"></i> Pengaturan Profil</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-4">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-4 text-center">
                <img id="previewFoto" src="{{ Auth::user()->foto != 'default.jpeg' ? asset('storage/' . Auth::user()->foto) : asset('img/photos/'. Auth::user()->foto) }}"
                     alt="Foto Profil" class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;" />
                <div>
                  <input type="file" name="foto" class="form-control d-inline-block" style="max-width: 300px;" accept="image/*" onchange="previewImage(event)" />
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" value="{{ Auth::user()->name }}" />
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" />
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold">NIS</label>
                <input type="text" name="nis" class="form-control" value="{{ Auth::user()->NIS }}" />
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold">No WhatsApp</label>
                <input type="text" name="wa" class="form-control" value="{{ Auth::user()->nomorwa }}" />
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold">Password Baru</label>
                <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah" />
              </div>
              <div class="modal-footer border-0">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
              </div>
            </form>
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

      toggleBtn.addEventListener("click", () => {
        sidebar.classList.toggle("show");

        toggleBtn.style.transition = "margin-left 0.3s ease";

        if (sidebar.classList.contains("show")){
          toggleBtn.style.marginLeft = "240px"
          toggleBtn.innerHTML = '<i class="bi bi-x"></i>'
        }else {
          toggleBtn.style.marginLeft = "0px"
          toggleBtn.innerHTML = '<i class="bi bi-list"></i>'
        }

        if (window.innerWidth <= 767.98) {
          sidebar.classList.remove("hide");
        } else {
          sidebar.classList.toggle("hide");
          mainContent.style.marginLeft = sidebar.classList.contains("hide") ? "0" : "240px";
        }
      });

      function previewImage(event) {
        let reader = new FileReader();
        reader.onload = function () {
          document.getElementById("previewFoto").src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
      }
    </script>
  </body>
</html>