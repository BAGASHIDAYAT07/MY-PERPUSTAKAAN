<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>{{ $title ?? 'Beranda' }} - MY-PERPUSTAKAAN</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"/>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet"/>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet"/>

    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

    <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
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
        left: 240px;
        right: 0;
        height: 70px;
        z-index: 1000;
        width: calc(100% - 240px);
      }

      .navbar .dropdown-menu {
        right: 0;
        left: auto;
      }

      /* Sidebar */
      #sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 240px;
        height: 100vh;
        background-color: #fff;
        z-index: 1050;
        padding: 20px 15px;
        overflow-y: auto;
      }

      #sidebar::-webkit-scrollbar {
        display: none;
      }

      #sidebar .nav-link {
        color: #212529;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
      }

      #sidebar .nav-link:hover {
        background-color: #C3F4DD;
        color: #0f5132;
        border-radius: 8px;
      }

      /* Main Content */
      #main-content {
        margin-left: 240px;
        padding-top: 110px;
        transition: margin-left 0.3s ease-in-out;
      }

      /* Mobile View */
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

      /* Dropdown Menu */
      .dropdown-item {
        border-radius: 6px;
        transition: background 0.2s ease, color 0.2s ease;
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
    </style>
  </head>

  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand bg-white shadow-sm px-1">
      <div class="container-fluid d-flex justify-content-between align-items-center">
        <!-- Judul Halaman -->
        <div>
          <h5 class="mb-0 text-dark fw-semibold">{{ $title ?? 'Dashboard' }}</h5>
          <small class="text-success">{{ $subtitle ?? 'Dashboard' }}</small>
        </div>

        <!-- Notifikasi + User -->
        <div class="d-flex align-items-center">
          <a href="#" class="text-dark me-4"><i class="bi bi-bell fs-5"></i></a>

          <!-- User Dropdown -->
          <div class="dropdown">
            <a class="d-flex align-items-center text-decoration-none" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="text-end me-2">
                <div class="fw-semibold text-dark">{{ auth()->user()->name ?? 'BangGazz' }}</div>
                <small class="text-muted">{{ auth()->user()->role ?? 'Admin' }}</small>
              </div>
              <img src="{{ asset('img/photos/admin.jpg') }}" alt="User" class="rounded-circle" style="width: 38px; height: 38px; object-fit: cover; cursor: pointer;">
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow rounded-3 border-0" aria-labelledby="userDropdown" style="min-width: 200px;">
              <li>
                <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#" data-bs-toggle="modal" data-bs-target="#pengaturanModal">
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
                <a class="merah d-flex align-items-center gap-2 py-2" style="padding-left: 17px; text-decoration: none;" href="/login">
                  <i class="bi bi-box-arrow-right"></i> Keluar
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <!-- Sidebar -->
    <div id="sidebar" class="d-flex flex-column shadow-sm">
      <div class="text-center mb-4">
        <img src="{{ asset('img/logo/smk.png') }}" alt="Logo" style="width: 60px;">
        <h5 class="mt-4 fw-bold text-success" style="font-size: 19px;">MY PERPUSTAKAAN</h5>
        <p class="text-muted small" style="font-size: 12px; font-weight: 500;">Sistem Informasi Perpustakaan</p>
      </div>

      <nav class="nav flex-column flex-grow-1">
        <a class="nav-link mb-2 fw-semibold rounded py-2 px-3 {{ $active == 'dashboard' ? 'bg-success text-white' : 'text-muted' }}" href="/">
          <i class="bi bi-grid-fill me-2"></i> Dashboard
        </a>

        <!-- User Dropdown -->
        <div class="nav-item mb-2">
          <a class="nav-link d-flex justify-content-between align-items-center text-muted fw-semibold px-3 py-2 rounded" data-bs-toggle="collapse" href="#menuUser" role="button" aria-expanded="false">
            <span><i class="bi bi-people-fill me-2"></i> Kelola Siswa</span>
            <i class="bi bi-caret-down-fill small"></i>
          </a>
          <div class="collapse ps-4" id="menuUser">
            <a class="nav-link rounded {{ $active == 'user' ? 'bg-success text-white' : 'text-muted' }}" href="/user">
              <i class="bi bi-person-fill-gear me-2"></i> Daftar Siswa
            </a>
            <a class="nav-link rounded {{ $active == 'verifikasiuser' ? 'bg-success text-white' : 'text-muted' }}" href="/VerifikasiUser">
              <i class="bi bi-person-fill-check me-2"></i> Verifikasi Siswa
            </a>
          </div>
        </div>

        <!-- Buku Dropdown -->
        <div class="nav-item mb-2">
          <a class="nav-link d-flex justify-content-between align-items-center text-muted fw-semibold px-3 py-2 rounded" data-bs-toggle="collapse" href="#menuBuku" role="button" aria-expanded="false">
            <span><i class="bi bi-journal-bookmark-fill me-2"></i> Kelola Buku</span>
            <i class="bi bi-caret-down-fill small"></i>
          </a>
          <div class="collapse ps-4" id="menuBuku">
            <a class="nav-link rounded {{ $active == 'veriv' ? 'bg-success text-white' : 'text-muted' }}" href="/bukuveriv">
              <i class="bi bi-clipboard2-check-fill me-2"></i> Verifikasi Peminjaman
            </a>
            <a class="nav-link rounded {{ $active == 'rakbuku' ? 'bg-success text-white' : 'text-muted' }}" href="/rakbuku">
              <i class="bi bi-collection-fill me-2"></i> Rak Buku
            </a>
          </div>
        </div>

        <a class="nav-link d-flex align-items-center text-muted fw-semibold px-3 py-2 rounded {{ $active == 'laporan' ? 'bg-success text-white' : 'text-muted' }}" href="/laporan">
          <i class="bi bi-file-earmark-text-fill me-2"></i> Laporan
        </a>
      </nav>
    </div>

    <!-- Main Content -->
    <div id="main-content">
      <main>@yield("konten")</main>
    </div>

    <!-- Modal Pengaturan -->
    <div class="modal fade" id="pengaturanModal" tabindex="-1" aria-labelledby="pengaturanModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
          <div class="modal-header bg-success text-white rounded-top-4">
            <h5 class="modal-title fw-bold" id="pengaturanModalLabel"><i class="bi bi-gear me-2"></i> Pengaturan Profil</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body p-4">
            <form>
              <div class="mb-4 text-center">
                <img id="previewFoto" src="{{ asset('img/photos/user.jpg') }}" alt="Foto Profil" class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #3b8763;"/>
                <input type="file" class="form-control d-inline-block mt-2" style="max-width: 300px;" accept="image/*" onchange="previewImage(event)"/>
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold">Nama Lengkap</label>
                <input type="text" class="form-control" value="{{ auth()->user()->name ?? 'Admin' }}"/>
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control" value="{{ auth()->user()->email ?? 'admin@contoh.com' }}"/>
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold">Password Baru</label>
                <input type="password" class="form-control" placeholder="••••••••"/>
              </div>
            </form>
          </div>
          <div class="modal-footer border-0">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-success">Simpan Perubahan</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
    <script>
      function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById("previewFoto");
        if (input.files && input.files[0]) {
          const reader = new FileReader();
          reader.onload = e => preview.src = e.target.result;
          reader.readAsDataURL(input.files[0]);
        }
      }
    </script>
  </body>
</html>
