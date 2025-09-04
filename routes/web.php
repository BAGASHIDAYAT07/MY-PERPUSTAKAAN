<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

// Route::get('/', [AuthController::class, 'home']);
Route::get('/register', [AuthController::class, 'ViewRegister']);
Route::get('/login', [AuthController::class, 'ViewLogin']);
Route::get('/dashboard', [AdminController::class, 'Dashboard']);
Route::get('/pinjaman',[AdminController::class, 'tes']);
// Route::get('/create',[AdminController::class, 'create']);
// Route::get('/peminjaman/{id}/edit', [PeminjamanController::class, 'edit'])->name('peminjaman.edit');
