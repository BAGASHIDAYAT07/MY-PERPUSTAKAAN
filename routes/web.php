<?php

use App\Http\Controllers\PinjamanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

// admin
Route::get('/dashboard', [AdminController::class, 'Dashboard']);
Route::get('/buku', [AdminController::class, 'Buku']);
Route::get('/user', [AdminController::class, 'User']);

// auth
Route::get('/register', [AuthController::class, 'ViewRegister']);
Route::get('/login', [AuthController::class, 'ViewLogin']);


Route::get('/', [AuthController::class, 'home']);
Route::get('/pinjam',[AdminController::class, 'tes']);
Route::get('/create',[PinjamanController::class, 'create']);
Route::get('/peminjaman/{id}/edit', [PinjamanController::class, 'edit']);
