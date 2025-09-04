<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'home']);
Route::get('/register', [AuthController::class, 'ViewRegister']);
Route::get('/login', [AuthController::class, 'ViewLogin']);
Route::get('/dashboard', [AdminController::class, 'Dashboard']);
Route::get('/testing',[AdminController::class, 'tes']);