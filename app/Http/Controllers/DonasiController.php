<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('donasi', 'public');
        }

        Donasi::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('donasi.success');
    }

    public function index()
    {
        $donasi = Donasi::where('user_id', auth()->id())->get();

        // Hitung status pengiriman (anggap kolom 'status' di tabel donasi ada)
        $statusCount = [
            'menunggu' => $donasi->where('status', 'menunggu')->count(),
            'diterima' => $donasi->where('status', 'diterima')->count(),
        ];

        return view('Dashboard.Donatur', compact('donasi', 'statusCount'));
    }
}
