<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login My-perpustakaan</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  
  <!-- AOS ANIMATED -->
   <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


  <style>
  html, body {
    height: 100%;
    margin: 0;
    overflow: hidden; /* cegah scroll */
  }

  body {
    background-color: #f5f6f7;
  }

  .vh-100 {
    height: 100vh !important;
    overflow: hidden;
  }

  .login-card {
    max-width: 950px;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
  }
    .login-left {
      padding: 50px 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
    }
    .login-left img.logo {
      width: 70px; /* kecilin logo */
      margin-bottom: 15px;
    }
    .login-left h3 {
      font-size: 1.4rem;
      margin-bottom: 5px;
    }
    .login-left h6 {
      font-weight: 500;
      margin-bottom: 30px;
      line-height: 1.5;
      font-size: 0.95rem;
    }

    /* Input dengan garis bawah */
    .input-group {
      border-bottom: 2px solid #aaa;
      margin-bottom: 25px;
    }
    .input-group:focus-within {
      border-color: #8cc84b;
    }
    .input-group .form-control,
    .input-group .input-group-text {
      border: none !important;
      box-shadow: none !important;
      background: transparent;
    }
    .input-group .form-control {
      border-radius: 0;
      height: 45px;
      font-size: 0.95rem;
    }
    .input-group .input-group-text {
      cursor: pointer;
    }

    /* Tombol login */
    .btn-login {
      border-radius: 30px;
      background-color: #8cc84b;
      color: white;
      font-weight: 600;
      height: 45px;
      font-size: 1rem;
      transition: background-color 0.3s ease;
    }
    .btn-login:hover {
      background-color: #7ab33f;
    }

    /* Gambar kanan */
    .login-right img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-top-right-radius: 20px;
      border-bottom-right-radius: 20px;
    }
    @media (max-width: 768px) {
      .login-right img {
        border-radius: 0 0 20px 20px;
        height: 220px;
      }
    }
  </style>
</head>
<body>
  <div class="d-flex justify-content-center align-items-center vh-100 p-3" data-aos="fade-up">
    <div class="card login-card">
      <div class="row g-0">
        
        <!-- Form kiri -->
        <div class="col-md-6 login-left">
          <img src="../img/logo/smk.png" alt="Logo" class="logo" />
          <h3>Selamat Datang</h3>
          <h6>Di Halaman Login My-perpustakaan</h6>

              @error('email')
      <small class="text-danger">{{ $message }}</small>
    @enderror

      @error('status')
    <small class="text-danger">{{ $message }}</small>
  @enderror

          <form class="w-100" action="{{ route('login.post') }}" method="post">
            @csrf
            <!-- Input Email -->
            <!-- Input Email -->
<div class="input-group">
  <input type="email" name="email" class="form-control" placeholder="Masukan Email" required />
  <span class="input-group-text"><i class="bi bi-envelope"></i></span>
</div>

<!-- Input Password -->
<div class="input-group">
  <input type="password" name="password" class="form-control" id="passwordInput" placeholder="Masukan Password" required />
  <button class="input-group-text" type="button" id="togglePassword">
    <i class="bi bi-eye-slash" id="toggleIcon"></i>
  </button>
</div>


            <button type="submit" class="btn btn-login w-100 mt-3">Login</button>

            <!-- Teks bawah -->
            <p class="mt-3 mb-0 text-center">
              Belum memiliki akun? 
              <a href="/register" class="text-decoration-none" style="color: #8cc84b; font-weight: 600;">
                Register
              </a>
            </p>
          </form>
        </div>

        <!-- Gambar kanan -->
        <div class="col-md-6 login-right p-2">
          <img src="../img/photos/perpush.png" alt="Perpustakaan" style="border-radius: 20px;"/>
        </div>
      </div>
    </div>
  </div>

 <!-- Bootstrap Toast Notification -->
<div class="position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 9999; margin-top: 20px;">
  @if (session('success'))
    <div class="toast align-items-center text-bg-success border-0 show shadow" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  @endif

  @if (session('error'))
    <div class="toast align-items-center text-bg-danger border-0 show shadow" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  @endif
</div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <script>
    // Toggle password
    const togglePassword = document.querySelector("#togglePassword");
    const passwordInput = document.querySelector("#passwordInput");
    const toggleIcon = document.querySelector("#toggleIcon");

    togglePassword.addEventListener("click", () => {
      const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
      passwordInput.setAttribute("type", type);
      toggleIcon.classList.toggle("bi-eye");
      toggleIcon.classList.toggle("bi-eye-slash");
    });

    // Tampilkan toast otomatis
  document.addEventListener('DOMContentLoaded', function () {
    const toastElList = [].slice.call(document.querySelectorAll('.toast'));
    toastElList.map(function (toastEl) {
      const toast = new bootstrap.Toast(toastEl, { delay: 4000 });
      toast.show();
    });
  });


  // Inisialisasi AOS
    AOS.init({
      duration: 800,
      once: true
    });
  </script>
</body>
</html>
