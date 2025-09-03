<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>Login Admin</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<style>
		.user-icon {
			width: 90px;
			height: 90px;
			border-radius: 50%;
			background: #4a90e2;
			display: flex;
			align-items: center;
			justify-content: center;
			margin: 0 auto 15px auto;
			color: white;
			font-size: 45px;
			box-shadow: 0px 4px 10px rgba(0,0,0,0.15);
		}
	</style>
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							
							<div class="user-icon">
								<i class="fa-solid fa-user"></i>
							</div>

							<h1 class="h2">Selamat Datang Kembali!</h1>
							<p class="lead">
								Daftar Pengguna
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-3">
									<form>
										<div class="mb-3">
											<label class="form-label">Nama</label>
											<input class="form-control form-control-lg" type="text" name="nama" placeholder="Masukan Namamu" />
										</div>
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" placeholder="Masukan email" />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Masukan password" />
										</div>
										<div class="mb-3">
											<label class="form-label">NIS</label>
											<input class="form-control form-control-lg" type="text" name="nis" placeholder="Masukan NIS" />
										</div>
										<div class="mb-3">
											<label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
											<select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
												<option value="" disabled selected>Pilih jenis kelamin</option>
												<option value="Laki-laki">Laki-laki</option>
												<option value="Perempuan">Perempuan</option>
											</select>
										</div>

										<div>
											<div class="form-check align-items-center">
												<input id="customControlInline" type="checkbox" class="form-check-input" value="remember-me" name="remember-me" checked>
												<label class="form-check-label text-small" for="customControlInline">Remember me</label>
											</div>
										</div>
										<div class="d-grid gap-2 mt-3">
											<a href="index.html" class="btn btn-lg btn-primary">Daftar</a>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="text-center mb-3">
							Sudah memiliki akun? <a href="/login">Login</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>

</body>
</html>
