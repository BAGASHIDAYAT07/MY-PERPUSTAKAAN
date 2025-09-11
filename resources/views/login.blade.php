<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login Admin My-perpustakaan</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f5f6f7;
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
      width: 100px;
      margin-bottom: 20px;
    }
    .login-left h6 {
      font-weight: 600;
      margin-bottom: 40px;
      line-height: 1.5;
    }
    .form-control {
      border: none;
      border-bottom: 2px solid #aaa;
      border-radius: 0;
      box-shadow: none;
      font-size: 1rem;
      height: 50px; /* tinggi input */
      margin-bottom: 25px;
    }
    .form-control:focus {
      border-color: #8cc84b;
      box-shadow: none;
    }
    .btn-login {
      border-radius: 30px;
      background-color: #8cc84b;
      color: white;
      font-weight: 600;
      height: 50px; /* tinggi tombol */
      font-size: 1rem;
      transition: background-color 0.3s ease;
    }
    .btn-login:hover {
      background-color: #7ab33f;
    }
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
        height: 250px;
      }
    }
  </style>
</head>
<body>
  <div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card login-card">
      <div class="row g-0">
        <!-- Form kiri -->
        <div class="col-md-6 login-left">
          <img src="../img/logo/smk.png" alt="Logo" class="logo" />
			<h3>Selamat Datang</h3>
			<h6>Di Halaman Login My-perpustakaan</h6>
          <form class="w-100">
            <input type="email" class="form-control" placeholder="Masukan Email" required />
            <input type="password" class="form-control" placeholder="Masukan Password" required />
            <button type="submit" class="btn btn-login w-100">Login</button>
          </form>
        </div>
        <!-- Gambar kanan -->
        <div class="col-md-6 login-right p-2">
          <img src="../img/photos/perpush.png" alt="Perpustakaan" style="border-radius: 20px;" />
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
