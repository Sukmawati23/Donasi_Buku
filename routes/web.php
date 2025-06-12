<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;

// Halaman Home
Route::get('/', function () {
    return view('welcome');
});

// Halaman
Route::get('/home', function () {
    return view('home'); 
})->name('home');

//Halaman Daftar
Route::get('/login', function () {
    return view('login'); 
})->name('login');

// Daftar Sebagai
Route::get('/daftar', function () {
    return view('auth.daftar');
})->name('daftar');

// Register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard (Hanya bisa diakses jika login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// ================================
// === Reset Password (Lupa) ====
// ================================

// Form untuk minta link reset password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Form untuk mengatur ulang password setelah klik link di email
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');