<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Beranda - MY-PERPUSTAKAAN</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />

    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

    <style>
      body {
        background-color: #f5f9fc;
        margin: 0;
        padding: 0;
      }

      /* Fixed Navbar */
      .navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1050;
        border-radius: 0;
      }

      /* Sidebar dengan animasi smooth */
      #sidebar {
        position: fixed;
        top: 70px; /* tinggi navbar */
        left: 0;
        width: 220px;
        height: calc(100vh - 70px);
        background-color: #3b8763;
        padding: 20px 15px;
        overflow-y: auto;
        z-index: 1000;
        transition: transform 0.3s ease-in-out; /* animasi smooth */
        transform: translateX(0); /* posisi normal */

        /* Hilangkan scrollbar */
        scrollbar-width: none; /* Firefox */
      }

      #sidebar::-webkit-scrollbar {
        display: none; /* Chrome, Safari */
      }

      #sidebar.hide {
        transform: translateX(-250px); /* geser keluar layar */
      }

      #sidebar .nav-link {
        color: #fff;
        font-weight: 500;
        margin: 5px 0;
        display: flex;
        align-items: center;
        gap: 8px;
      }

      #sidebar .nav-link.active {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 5px;
      }

      #sidebar .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 5px;
      }

      /* Main Content dengan transisi halus */
      #main-content {
        margin-left: 215px;
        padding-top: 100px; /* space for fixed navbar */
        transition: margin-left 0.3s ease-in-out; /* halus saat geser */
      }

      #main-content.full {
        margin-left: 15px;
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
        background-color: #E6F4EA; /* hijau muda */
        color: #2E7D32;
      }
    </style>
  </head>

  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-light bg-white shadow-sm px-3" style="height: 70px;">
      <div class="d-flex align-items-center">
        <button class="btn btn-link me-2" id="sidebarToggle">
          <i class="bi bi-list" style="color: black;"></i>
        </button>
        <img src="../img/logo/smk.png" alt="Logo" style="width: 45px; margin-right: 8px;" />
        <span class="fw-bold">MY-PERPUSTAKAAN</span>
      </div>

      <!-- Ikon & User -->
      <ul class="navbar-nav ms-auto d-flex align-items-center">
        <li class="nav-item mx-2">
          <a class="nav-link" href="#"><i class="bi bi-chat-dots" style="font-size: 20px;"></i></a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link" href="#"><i class="bi bi-bell" style="font-size: 20px;"></i></a>
        </li>
        <li class="nav-item dropdown mx-2">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../img/photos/user.jpg" class="rounded-circle me-2" style="width: 35px; height: 35px;" alt="User" />
            <span>Admin</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow rounded-3 border-0" aria-labelledby="userDropdown" style="min-width: 200px;">
            <li>
              <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#!">
                <i class="bi bi-gear text-success"></i> Pengaturan
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#!">
                <i class="bi bi-clock-history text-success"></i> Riwayat Aktivitas
              </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item d-flex align-items-center gap-2 py-2 fw-bold text-success" href="#!">
                <i class="bi bi-box-arrow-right"></i> Keluar
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>

    <!-- Sidebar -->
<div id="sidebar" class="shadow-sm p-2 rounded-4xl">
  <nav class="nav flex-column" style="padding: 10px 0;">
    <span class="text-white-50 small mb-2 px-2">Main Menu</span>
    <a class="nav-link text-white mb-2 active" href="/">
      <i class="bi bi-speedometer2 me-2"></i> Beranda
    </a>
    <a class="nav-link text-white mb-2" href="/user">
      <i class="bi bi-person me-2"></i> Pengguna
    </a>
    <a class="nav-link text-white mb-2" href="/rakbuku">
      <i class="bi bi-journal me-2"></i> Rak Buku
    </a>

    <hr class="text-white opacity-50 mt-3 mb-2">

    <span class="text-white-50 small mb-2 px-2">Verifikasi</span>
    <a class="nav-link text-white mb-2" href="/VerifikasiUser">
      <i class="bi bi-person-check me-2"></i> Verifikasi Pengguna
    </a>
    <a class="nav-link text-white mb-2" href="/bukuveriv">
      <i class="bi bi-clipboard-check me-2"></i> Verifikasi Peminjaman
      <span class="badge bg-light text-success ms-auto">3</span>
    </a>
  </nav>
</div>


    <!-- Main Content -->
    <div id="main-content">
      <main class="p-1">
        @yield("konten")
      </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>

    <script>
      // Sidebar toggle
      document.getElementById("sidebarToggle").addEventListener("click", () => {
        document.getElementById("sidebar").classList.toggle("hide");
        document.getElementById("main-content").classList.toggle("full");
      });
    </script>
  </body>
</html>
