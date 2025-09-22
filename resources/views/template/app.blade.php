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
        top: 70px; /* tinggi navbar */
        left: 0;
        width: 220px;
        height: calc(100vh - 70px);
        background-color: #3b8763;
        padding: 20px 15px;
        overflow-y: auto;
        z-index: 1000;
        transition: transform 0.3s ease-in-out;
        transform: translateX(0); /* default tampil */
        scrollbar-width: none;
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

      #sidebar .nav-link.active {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 5px;
      }

      #sidebar .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 5px;
      }

      /* Main Content */
      #main-content {
        margin-left: 215px; /* default geser karena sidebar tampil */
        padding-top: 100px;
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
    <nav
      class="navbar navbar-expand navbar-light bg-white shadow-sm px-3"
      style="height: 70px;"
    >
      <div class="d-flex align-items-center">
        <!-- Toggle Burger -->
        <button class="btn btn-link me-2" id="sidebarToggle">
          <i class="bi bi-list fs-4" style="color: black;"></i>
        </button>

        <!-- Logo -->
        <a href="/" class="d-flex align-items-center text-decoration-none">
          <img
            src="../img/logo/smk.png"
            alt="Logo"
            class="logo-nav"
            style="width: 45px; margin-right: 8px;"
          />
          <span class="fw-bold brand-text text-dark">MY-PERPUSTAKAAN</span>
        </a>
      </div>

      <!-- Ikon & User -->
      <ul class="navbar-nav ms-auto d-flex align-items-center">
        <li class="nav-item mx-2">
          <a class="nav-link" href="#"
            ><i class="bi bi-chat-dots" style="font-size: 20px;"></i
          ></a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link" href="#"
            ><i class="bi bi-bell" style="font-size: 20px;"></i
          ></a>
        </li>
        <li class="nav-item dropdown mx-2">
          <a
            class="nav-link dropdown-toggle d-flex align-items-center"
            href="#"
            id="userDropdown"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            <img
              src="../img/photos/user.jpg"
              class="rounded-circle me-2"
              style="width: 35px; height: 35px;"
              alt="User"
            />
            <span class="username-text">Admin</span>
          </a>
          <ul
            class="dropdown-menu dropdown-menu-end shadow rounded-3 border-0"
            aria-labelledby="userDropdown"
            style="min-width: 200px;"
          >
            <li>
              <a
                class="dropdown-item d-flex align-items-center gap-2 py-2"
                href="#"
                data-bs-toggle="modal"
                data-bs-target="#pengaturanModal"
              >
                <i class="bi bi-gear text-success"></i> Pengaturan
              </a>
            </li>
            <li>
              <a
                class="dropdown-item d-flex align-items-center gap-2 py-2"
                href="#!"
              >
                <i class="bi bi-clock-history text-success"></i> Riwayat Aktivitas
              </a>
            </li>
            <li><hr class="dropdown-divider" /></li>
            <li>
              <a
                class="dropdown-item d-flex align-items-center gap-2 py-2 fw-bold text-success"
                href="/login"
              >
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
          <i class="bi bi-person me-2"></i> User
        </a>
        <a class="nav-link text-white mb-2" href="/rakbuku">
          <i class="bi bi-journal me-2"></i> Rak Buku
        </a>

        <hr class="text-white opacity-50 mt-3 mb-2" />

        <span class="text-white-50 small mb-2 px-2">Verifikasi</span>
        <a class="nav-link text-white mb-2" href="/VerifikasiUser">
          <i class="bi bi-person-check me-2"></i> Verifikasi User
        </a>
        <a class="nav-link text-white mb-2" href="/bukuveriv">
          <i class="bi bi-clipboard-check me-2"></i> Verifikasi Peminjaman
          <span class="badge bg-light text-success ms-auto">3</span>
        </a>
      </nav>
    </div>

    <!-- Main Content -->
    <div id="main-content">
      <main class="p-1">@yield("konten")</main>
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
