<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('login'); // Sesuaikan dengan lokasi file view
    }

    // Tampilkan form registrasi
    public function showRegisterForm()
    {
        return view('auth.register'); // Sesuaikan dengan lokasi file view
    }

    // Proses registrasi
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'alamat'   => 'required|string|max:255',
            'telepon'  => 'required|string|max:15',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'alamat'   => $request->alamat,
            'telepon'  => $request->telepon,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user)); // Kirim email verifikasi
        Auth::login($user);

        return redirect()->route('verification.notice')->with('success', 'Registrasi berhasil! Silakan verifikasi email Anda.');
    }

    // Proses login
   // app/Http/Controllers/AuthController.php

public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Redirect langsung ke dashboard donatur
        return redirect()->route('dashboard.donatur');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
}



    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }
}
