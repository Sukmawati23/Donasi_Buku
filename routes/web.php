<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\ProfileController;


// Halaman Utama
Route::get('/', fn() => view('welcome'));

// Halaman Home setelah login
Route::get('/home', fn() => view('home'))
    ->middleware('auth')
    ->name('home');

// Dashboard - hanya untuk user login
Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware('auth')
    ->name('dashboard');

// =================== AUTH ======================

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login.post');

// Register
Route::get('/register', [AuthController::class, 'showRegisterForm'])
    ->middleware('guest')
    ->name('register');
Route::post('/register', [AuthController::class, 'register'])
    ->middleware('guest')
    ->name('register.post');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// =================== DAFTAR PERAN ======================

Route::middleware('guest')->group(function () {
    Route::get('/daftar', fn() => view('auth.daftar'))->name('daftar');
    Route::get('/daftar-donatur', fn() => view('auth.donatur'))->name('daftar.donatur');
    Route::get('/daftar-penerima', fn() => view('auth.penerima'))->name('daftar.penerima');
    Route::get('/register/donatur', fn() => view('auth.halDaf-donatur'))->name('register.donatur');
    Route::get('/register/penerima', fn() => view('auth.halDaf-penerima'))->name('register.penerima');
});

// =================== RESET PASSWORD ======================

Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
        ->name('password.update');
});

// =================== EMAIL VERIFIKASI ======================

Route::get('/email/verify', fn() => view('auth.verif-email'))
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('dashboard')->with('status', 'Email berhasil diverifikasi!');
})->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'Link verifikasi telah dikirim.');
})->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::middleware(['auth'])->group(function () {
    // Ini route GET untuk menampilkan halaman form donasi
    Route::get('/dashboard.donatur', [DonasiController::class, 'index'])->name('dashboard.donatur');

    // Ini route POST untuk submit form donasi
    Route::post('/dashboard.donatur', [DonasiController::class, 'store'])->name('donatur.donasi');
});

// Route untuk halaman donasi berhasil
Route::get('/donasi.success', function () {
    return view('dashboard.donatur_success');
})->name('donasi.success');

Route::get('/donasi/form', [DonasiController::class, 'create'])->name('donasi.form');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
