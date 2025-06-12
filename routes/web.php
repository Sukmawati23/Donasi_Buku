<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;

// Halaman utama (Welcome)
Route::get('/', function () {
    return view('welcome');
});

// Halaman setelah login
Route::get('/home', function () {
    return view('home');
})->name('home');

// Halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Halaman registrasi
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman daftar sebagai (jika ada tampilan pilihan)
Route::get('/daftar', function () {
    return view('auth.daftar');
})->name('daftar');

// Dashboard - hanya bisa diakses oleh user yang login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// ==========================================
// ============= RESET PASSWORD =============
// ==========================================

// Menampilkan form permintaan reset password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Menangani pengiriman email reset password
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Menampilkan form pengaturan ulang password
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Menyimpan password baru
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
