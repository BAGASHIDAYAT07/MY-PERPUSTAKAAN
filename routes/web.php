<?php

use App\Http\Controllers\PinjamanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientError;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BukuController; // 🔑 jangan lupa import
use App\Http\Controllers\VerivPinjamanAdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VerivUserAdminController;


// admin
Route::get('/', [AdminController::class, 'Dashboard'])->name('admin.dashboard');
Route::get('/dashboard/data/{tahun}/{bulan?}', [AdminController::class, 'DashboardData'])->name('admin.dashboard.data');
Route::get('/buku', [UserController::class, 'Buku']);
Route::get('/user', [AdminController::class, 'User']);
Route::post('/user/post', [AdminController::class, 'UserCreates'])->name('user.post');

//user
Route::get('/usecreate', [AdminController::class, 'Usecreate']);
Route::get('/useupdate', [AdminController::class, 'UserUpdate']);

//Verifikasi User
// Route::get('/VerifikasiUser', [AdminController::class,'VerifikasiUser']);
Route::get('/verifikasiuser', [VerivUserAdminController::class, 'index'])->name('verifikasi.index');
Route::post('/verifikasiuser/terima/{id}', [VerivUserAdminController::class, 'terima'])->name('verifikasi.terima');
Route::delete('/verifikasiuser/tolak/{id}', [VerivUserAdminController::class, 'tolak'])->name('verifikasi.tolak');

// buku (pindahkan ke BukuController)
Route::post('/buku/tambah', [BukuController::class, 'tambahbuku'])->name('buku.tambahbuku');
Route::put('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');
Route::post('/buku/{id}/toggle-status', [BukuController::class, 'toggleStatus'])->name('buku.toggleStatus');


// rakbuku (pindahkan ke BukuController)
Route::get('/rakbuku', [BukuController::class, 'RakBuku'])->name('rakbuku');

// auth
Route::get('/register', [AuthController::class, 'ViewRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'ViewLogin']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/logins', [AuthController::class, 'login'])->name('login.post');


//pinjaman
Route::get('/pinjaman',[PinjamanController::class, 'pinjamanUser'])->name('User.Peminjaman');
Route::get('/peminjaman/create', [PinjamanController::class, 'create'])->name('peminjaman.create' );
Route::get('/peminjaman/{peminjaman}/edit', [PinjamanController::class, 'edit'])->name('peminjaman.edit');
Route::post('/pinjamans', [PinjamanController::class, 'store'])->name('pinjaman.store');
Route::put('/peminjaman/{peminjaman}', [PinjamanController::class, 'update'])->name('peminjaman.update');
Route::delete('/peminjaman/{peminjaman}', [PinjamanController::class, 'destroy'])->name('peminjaman.destroy');
Route::post('/pinjam-buku/{id}', [PinjamanController::class, 'pinjam'])->name('pinjam.buku');

//pinjam buku admin
// Route::get('/bukuveriv',[VerivPinjamanAdminController::class, 'veriv']);
Route::middleware(['auth'])->group(function () {
    Route::get('/bukuveriv', [VerivPinjamanAdminController::class, 'veriv'])->name('veriv.pinjaman');
    Route::get('/bukuveriv/setujui/{id}', [VerivPinjamanAdminController::class, 'setujui'])->name('veriv.setujui');
    Route::get('/bukuveriv/tolak/{id}', [VerivPinjamanAdminController::class, 'tolak'])->name('veriv.tolak');
    Route::get('/verifikasi/kembalikan/{id}', [VerivPinjamanAdminController::class, 'kembalikan'])->name('veriv.kembalikan');
});


// untuk user
Route::get('/Home',[UserController::class, 'Home']);
Route::get('/Favorit',[UserController::class, 'Favorit']);
Route::get('/pinjaman_detail',[PinjamanController::class, 'detail']);

//history
// 🔹 History User (tambah fitur hapus)
Route::middleware(['auth'])->group(function () {
    Route::get('/History', [UserController::class, 'History'])->name('history.index');
    Route::delete('/History/{id}', [UserController::class, 'destroy'])->name('history.destroy');
});



// user actions
Route::post('/user/{id}/toggle-status', [AdminController::class, 'toggleStatus'])->name('user.toggle-status');
Route::put('/user/{id}', [AdminController::class, 'update'])->name('user.update');


//profil
// Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])
    ->name('profile.update');
