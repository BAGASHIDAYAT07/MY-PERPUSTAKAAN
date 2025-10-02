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


// admin
Route::get('/', [AdminController::class, 'Dashboard']);
Route::get('/buku', [UserController::class, 'Buku']);
Route::get('/user', [AdminController::class, 'User']);
Route::post('/user/post', [AdminController::class, 'UserCreates'])->name('user.post');

//user
Route::get('/usecreate', [AdminController::class, 'Usecreate']);
Route::get('/useupdate', [AdminController::class, 'UserUpdate']);
Route::get('/VerifikasiUser', [AdminController::class,'VerifikasiUser']);

// buku (pindahkan ke BukuController)
Route::post('/buku/tambah', [BukuController::class, 'tambahbuku'])->name('buku.tambahbuku');
Route::put('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');
Route::post('/buku/{id}/toggle-status', [BukuController::class, 'toggleStatus'])->name('buku.toggleStatus');


// rakbuku (pindahkan ke BukuController)
Route::get('/rakbuku', [BukuController::class, 'RakBuku'])->name('rakbuku');

// auth
Route::get('/register', [AuthController::class, 'ViewRegister']);
Route::get('/login', [AuthController::class, 'ViewLogin']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/logins', [AuthController::class, 'login'])->name('login.post');


//pinjaman
Route::get('/pinjaman',[PinjamanController::class, 'index']);
Route::get('/peminjaman/create', [PinjamanController::class, 'create'])->name('peminjaman.create' );
Route::get('/pinjaman_update/{id}',[PinjamanController::class, 'edit']);
Route::get('/bukuveriv',[VerivPinjamanAdminController::class, 'veriv']);

// untuk user
Route::get('/Home',[UserController::class, 'Home']);
Route::get('/Favorit',[UserController::class, 'Favorit']);
Route::get('/pinjaman_detail',[PinjamanController::class, 'detail']);
Route::get('/History', [UserController::class, 'History'])->name('User.History');


// user actions
Route::post('/user/{id}/toggle-status', [AdminController::class, 'toggleStatus'])->name('user.toggle-status');
Route::put('/user/{id}', [AdminController::class, 'update'])->name('user.update');


//profil
// Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])
    ->name('profile.update');
