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

// Halaman daftar sebagai Donatur
Route::get('/daftar-donatur', function () {
    return view('auth.donatur');
})->name('daftar.donatur');

// Halaman daftar sebagai Penerima
Route::get('/daftar-penerima', function () {
    return view('auth.penerima');
})->name('daftar.penerima');
// Halaman daftar donatur
Route::get('/register/donatur', function () {
    return view('auth.halDaf-donatur');
})->name('register.donatur');

// Halaman daftar penerima
Route::get('/register/penerima', function () {
    return view('auth.halDaf-penerima');
})->name('register.penerima');

// Kirim form register ke controller
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

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
