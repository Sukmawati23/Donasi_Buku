<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Donatur;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('login'); // Sesuaikan dengan file view login
    }

    // Tampilkan form registrasi
    public function showRegisterForm()
    {
        return view('auth.register'); // Sesuaikan dengan file view register
    }

    // Proses registrasi
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'alamat'   => 'required|string|max:255',
            'telepon'  => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:donatur,penerima',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'alamat'   => $request->alamat,
            'telepon'  => $request->telepon,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        event(new Registered($user));
        Auth::login($user);

        // Redirect sesuai peran
        if ($user->role === 'penerima') {
            return redirect()->route('dashboard.penerima');
        } else {
            return redirect()->route('dashboard.donatur');
        }
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $donatur = Donatur::where('email', $user->email)->first();

            if ($donatur) {
                session(['idDonatur' => $donatur->idDonatur]);
            }

            return redirect()->route($user->role === 'penerima' ? 'dashboard.penerima' : 'dashboard.donatur');
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
