<?php

use App\Http\Controllers\PinjamanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientError;

// admin
Route::get('/', [AdminController::class, 'Dashboard']);
Route::get('/buku', [AdminController::class, 'Buku']);
Route::get('/user', [AdminController::class, 'User']);
Route::get('/rakbuku', [AdminController::class, 'RakBuku']);

//user
Route::get('/usecreate', [AdminController::class, 'Usecreate']);
Route::get('/useupdate', [AdminController::class, 'UserUpdate']);
Route::get('/VerifikasiUser', [AdminController::class,'VerifikasiUser']);

//buku
Route::get('/createbuk', [AdminController::class, 'Bukucreate']);
Route::get('/updatebuk', [AdminController::class, 'Bukupdate']);


// auth
Route::get('/register', [AuthController::class, 'ViewRegister']);
Route::get('/login', [AuthController::class, 'ViewLogin']);

//pinjaman
Route::get('/pinjam',[AdminController::class, 'tes']);
Route::get('/pinjaman_create',[PinjamanController::class, 'create']);
Route::get('/pinjaman_update/{id}',[PinjamanController::class, 'edit']);