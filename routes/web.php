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

//user
Route::get('/usecreate', [AdminController::class, 'Usecreate']);


//buku
Route::get('/createbuk', [AdminController::class, 'Bukcreate']);
Route::get('/updatebuk', [AdminController::class, 'Bukupdate']);


// auth
Route::get('/register', [AuthController::class, 'ViewRegister']);
Route::get('/login', [AuthController::class, 'ViewLogin']);

//pinjaman
Route::get('/pinjam',[AdminController::class, 'tes']);
Route::get('/pinjaman_create',[PinjamanController::class, 'create']);
Route::get('/pinjaman_update/{id}',[PinjamanController::class, 'edit']);