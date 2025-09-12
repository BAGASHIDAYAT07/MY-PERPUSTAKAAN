<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Admin My-perpustakaan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f5f6f7;
    }
    .register-card {
      max-width: 850px;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }
    .register-left img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-top-left-radius: 20px;
      border-bottom-left-radius: 20px;
    }
    .register-right {
      padding: 35px 30px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
    }
    .register-right img.logo {
      width: 80px;
      margin-bottom: 15px;
    }
    .register-right h3 {
      margin-bottom: 5px;
    }
    .register-right h6 {
      font-weight: 600;
      margin-bottom: 30px;
      line-height: 1.5;
      font-size: 0.95rem;
    }

    /* Input dengan garis bawah */
    .input-group {
      border-bottom: 2px solid #aaa;
      margin-bottom: 20px;
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

    /* Select tetap polos */
    .form-select {
      border: none;
      border-bottom: 2px solid #aaa;
      border-radius: 0;
      box-shadow: none;
      font-size: 0.95rem;
      height: 45px;
      margin-bottom: 20px;
      background: transparent;
    }
    .form-select:focus {
      border-color: #8cc84b;
      box-shadow: none;
    }

    /* Tombol daftar */
    .btn-register {
      border-radius: 25px;
      background-color: #8cc84b;
      color: white;
      font-weight: 600;
      height: 45px;
      font-size: 0.95rem;
      transition: background-color 0.3s ease;
    }
    .btn-register:hover {
      background-color: #7ab33f;
    }

    @media (max-width: 768px) {
      .register-left img {
        border-radius: 20px 20px 0 0;
        height: 250px;
      }
    }
  </style>
</head>
<body>
  <div class="d-flex justify-content-center align-items-center min-vh-100 p-3">
    <div class="card register-card">
      <div class="row g-0">
        
        <!-- Gambar kiri -->
        <div class="col-md-6 register-left p-2">
          <img src="../img/photos/perpush.png" alt="Foto Register" style="border-radius: 20px;"/>
        </div>

        <!-- Form kanan -->
        <div class="col-md-6 register-right">
          <img src="../img/logo/smk.png" alt="Logo" class="logo" />
          <h3>Selamat Datang</h3>
          <h6>Buat akun baru untuk My-perpustakaan</h6>

          <form class="w-100">
            <div class="row">
              <div class="col-md-6">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Masukkan Nama" required>
                  <span class="input-group-text"><i class="bi bi-person"></i></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group">
                  <input type="email" class="form-control" placeholder="Masukkan Email" required>
                  <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="input-group">
                  <input type="password" class="form-control" id="passwordInput" placeholder="Masukkan Password" required>
                  <button class="input-group-text" type="button" id="togglePassword">
                    <i class="bi bi-eye-slash" id="toggleIcon"></i>
                  </button>
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Masukkan NIS" required>
                  <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                </div>
              </div>
            </div>

            <!-- Select tanpa icon -->
            <select class="form-select w-100">
              <option selected disabled>Pilih jenis kelamin</option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>

            <button type="submit" class="btn btn-register w-100">Daftar</button>

            <!-- Teks bawah button -->
            <p class="mt-3 mb-0 text-center">
              Sudah punya akun? 
              <a href="/login" class="text-decoration-none" style="color: #8cc84b; font-weight: 600;">
                Login
              </a>
            </p>
          </form>
        </div>

      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
  </script>
</body>
</html>
