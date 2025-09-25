<?php

use App\Http\Controllers\PinjamanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientError;
use App\Http\Controllers\UserController;

// admin
Route::get('/', [AdminController::class, 'Dashboard']);
Route::get('/buku', [UserController::class, 'Buku']);
Route::get('/user', [AdminController::class, 'User']);
Route::post('/user/post', [AdminController::class, 'UserCreates'])->name('user.post');

//user
Route::get('/usecreate', [AdminController::class, 'Usecreate']);
Route::get('/useupdate', [AdminController::class, 'UserUpdate']);
Route::get('/VerifikasiUser', [AdminController::class,'VerifikasiUser']);

//buku
Route::get('/createbuk', [AdminController::class, 'Bukucreate']);
Route::get('/updatebuk', [AdminController::class, 'Bukupdate']);

//rakbuku
Route::get('/rakbuku', [AdminController::class, 'Rakbuku']);


// auth
Route::get('/register', [AuthController::class, 'ViewRegister']);
Route::get('/login', [AuthController::class, 'ViewLogin']);

//pinjaman
Route::get('/pinjam',[AdminController::class, 'tes']);
Route::get('/pinjaman_create',[PinjamanController::class, 'create']);
Route::get('/pinjaman_update/{id}',[PinjamanController::class, 'edit']);
Route::get('/bukuveriv',[PinjamanController::class, 'veriv']);

//untuk user
Route::get('/Home',[UserController::class, 'Home']);
Route::get('/Favorit',[UserController::class, 'Favorit']);
Route::get('/Peminjaman',[UserController::class, 'Peminjaman']);
Route::get('/History',[UserController::class, 'History']);
Route::get('/pinjaman_detail',[PinjamanController::class, 'detail']);

Route::post('/user/{id}/toggle-status', [AdminController::class, 'toggleStatus'])->name('user.toggle-status');
Route::put('/user/{id}', [AdminController::class, 'update'])->name('user.update');

Route::post('/buku/tambah', [AdminController::class, 'tambahbuku'])->name('buku.tambahbuku');