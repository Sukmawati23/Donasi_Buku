<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

class PenerimaController extends Controller
{
    public function index()
    {
        $pengajuans = Pengajuan::with('buku')
            ->where('idPenerima', Auth::id()) // Sesuaikan kalau nama kolomnya beda
            ->get();

        return view('dashboard.penerima', compact('pengajuans'));
    }

    public function daftarBuku()
    {
        return view('penerima.daftar-buku');
    }
}
