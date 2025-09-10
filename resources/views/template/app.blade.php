<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - MY-PERPUSTAKAAN</title>

    <!-- Styles -->
    <link
      href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css"
      rel="stylesheet"
    />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />

    <!-- Chart.js -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
      crossorigin="anonymous"
    ></script>

    <style>
      body {
        background-color: #f5f9fc;
      }

      /* Sidebar */
      #sidebar {
        background-color: #3b8763;
        min-height: 100vh;
        border-radius: 15px;
        margin: 15px 0 15px 15px;
        padding-top: 20px;
        transition: all 0.3s ease;
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
        border-radius: 10px;
      }

      #sidebar .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
      }

      #sidebar.hide {
        margin-left: -250px;
      }
    </style>
  </head>

  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-light bg-white shadow-sm px-3 m-3" style="border-radius: 15px;">
      <div class="d-flex align-items-center">
        <!-- Tombol Sidebar -->
        <button class="btn btn-link me-2" id="sidebarToggle">
          <i class="fa fa-bars" style="color: black;"></i>
        </button>

        <!-- Logo + Nama -->
        <img
          src="../img/logo/smk.png"
          alt="Logo"
          style="width: 45px; margin-right: 8px;"
        />
        <span class="fw-bold">MY-PERPUSTAKAAN</span>
      </div>

      <!-- Search Box -->
      <form
        class="d-none d-md-inline-block mx-auto w-50"
        style="border: 0.5px solid #ccc; border-radius: 10px;"
      >
        <div class="input-group">
          <input
            class="form-control border-0 shadow-sm"
            type="text"
            placeholder="Search For ....."
          />
          <button
            class="btn border-0"
            type="button"
            style="background-color: #3b8763; color: #fff;"
          >
            <i class="fa fa-search"></i>
          </button>
        </div>
      </form>

      <!-- Icon + User -->
      <ul class="navbar-nav ms-auto d-flex align-items-center">
        <li class="nav-item mx-2">
          <a class="nav-link" href="#">
            <i class="fa fa-commenting-o" style="font-size: 20px;"></i>
          </a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link" href="#">
            <i class="fa fa-bell-o" style="font-size: 20px;"></i>
          </a>
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
            <span>Admin</span>
          </a>
          <ul
            class="dropdown-menu dropdown-menu-end"
            aria-labelledby="userDropdown"
          >
            <li><a class="dropdown-item" href="#!">Settings</a></li>
            <li><a class="dropdown-item" href="#!">Activity Log</a></li>
            <li><hr class="dropdown-divider" /></li>
            <li><a class="dropdown-item" href="#!">Logout</a></li>
          </ul>
        </li>
      </ul>
    </nav>
    
    <!-- Layout -->
    <div class="container-fluid">
      <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2" id="sidebar">
          <nav class="nav flex-column">
            <a class="nav-link active" href="/dashboard">
              <i class="fa fa-tachometer"></i> Dashboard
            </a>
            <a class="nav-link" href="/buku">
              <i class="fa fa-book"></i> Buku
            </a>
            <a class="nav-link" href="/user">
              <i class="fa fa-user"></i> User
            </a>
          </nav>
        </div>

        <!-- Main Content -->
        <div class="col-md-10">
          <main class="p-3">
            @yield("konten")
          </main>
        </div>
      </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>

    <script>
      // Sidebar toggle
      document
        .getElementById("sidebarToggle")
        .addEventListener("click", () => {
          document.getElementById("sidebar").classList.toggle("hide");
        });
    </script>
  </body>
</html>
