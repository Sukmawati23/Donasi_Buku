<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengajuan;
use App\Models\Buku;

class PenerimaController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register-penerima'); // Pastikan ini ada
    }
    public function index()
{
     $pengajuan = Pengajuan::all();
   return view('dashboard.penerima', compact('pengajuan'));
 // ⬅️ pastikan view ini ada
}
public function daftarBuku()
{
    $bukus = Buku::where('user_id', Auth::id())->get(); // hanya buku dari user saat ini
    return view('dashboard.daftar_buku', compact('bukus'));
}


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'penerima', // ⬅️ PENTING
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard.penerima');
    }
}
