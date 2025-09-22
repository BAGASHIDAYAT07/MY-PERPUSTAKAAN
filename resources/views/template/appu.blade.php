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

      .navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1050;
      }

      #sidebar {
        position: fixed;
        top: 70px;
        left: 0;
        width: 220px;
        height: calc(100vh - 70px);
        background-color: #3b8763;
        padding: 20px 15px;
        overflow-y: auto;
        z-index: 1000;
        transition: transform 0.3s ease-in-out;
        transform: translateX(0);
        scrollbar-width: none;
      }

      #sidebar.hide {
        transform: translateX(-250px);
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

      #main-content {
        margin-left: 215px;
        padding-top: 100px;
        transition: margin-left 0.3s ease-in-out;
      }

      @media (max-width: 767.98px) {
        #sidebar {
          transform: translateX(-250px);
        }

        #sidebar.show {
          transform: translateX(0);
        }

        #main-content {
          margin-left: 0 !important;
        }

        .logo-nav,
        .brand-text,
        .username-text {
          display: none !important;
        }
      }
    </style>
  </head>

  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-light bg-white shadow-sm px-3" style="height: 70px;">
      <div class="d-flex align-items-center">
        <button class="btn btn-link me-2" id="sidebarToggle">
          <i class="bi bi-list fs-4" style="color: black;"></i>
        </button>
        <a href="/" class="d-flex align-items-center text-decoration-none">
          <img src="../img/logo/smk.png" alt="Logo" class="logo-nav" style="width: 45px; margin-right: 8px;" />
          <span class="fw-bold brand-text text-dark">MY-PERPUSTAKAAN</span>
        </a>
      </div>

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
            <span class="username-text">User</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow rounded-3 border-0" aria-labelledby="userDropdown">
            <li>
              <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#" data-bs-toggle="modal" data-bs-target="#pengaturanModal">
                <i class="bi bi-gear text-success"></i> Pengaturan
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="/riwayat">
                <i class="bi bi-clock-history text-success"></i> Riwayat Peminjaman
              </a>
            </li>
            <li><hr class="dropdown-divider" /></li>
            <li>
              <a class="dropdown-item d-flex align-items-center gap-2 py-2 fw-bold text-success" href="/login">
                <i class="bi bi-box-arrow-right"></i> Keluar
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>

    <!-- Sidebar khusus user -->
    <div id="sidebar" class="shadow-sm p-2 rounded-4xl">
      <nav class="nav flex-column">
        <span class="text-white-50 small mb-2 px-2">Menu</span>

        <a class="nav-link text-white mb-2 active" href="/Home">
          <i class="bi bi-house me-2"></i> Home
        </a>

        <a class="nav-link text-white mb-2" href="/buku">
          <i class="bi bi-journal-bookmark me-2"></i> Buku
        </a>

        <a class="nav-link text-white mb-2" href="/Favorit">
          <i class="bi bi-heart me-2"></i> Favorit
        </a>

        <a class="nav-link text-white mb-2" href="/peminjaman">
          <i class="bi bi-journal-arrow-down me-2"></i> Peminjaman
        </a>

        <a class="nav-link text-white mb-2" href="/history">
          <i class="bi bi-clock-history me-2"></i> History
        </a>

        <a class="nav-link text-white mb-2" href="/help">
          <i class="bi bi-question-circle me-2"></i> Help
        </a>
      </nav>
    </div>


    <!-- Main Content -->
    <div id="main-content">
      <main class="p-1">@yield("kontenU")</main>
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
    <script>
      const sidebar = document.getElementById("sidebar");
      const toggleBtn = document.getElementById("sidebarToggle");
      const mainContent = document.getElementById("main-content");

      toggleBtn.addEventListener("click", () => {
        if (window.innerWidth > 768) {
          sidebar.classList.toggle("hide");
          mainContent.style.marginLeft = sidebar.classList.contains("hide") ? "0" : "215px";
        } else {
          sidebar.classList.toggle("show");
        }
      });

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
