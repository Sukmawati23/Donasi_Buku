<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DonasiController extends Controller
{
    /**
     * Tampilkan dashboard donatur beserta data donasi miliknya
     */
    public function index()
    {
        // Ambil semua donasi berdasarkan idDonatur dari session
        $donasi = Donasi::where('idDonatur', session('idDonatur'))->get();

        // Hitung jumlah status
        $statusCount = [
            'menunggu' => $donasi->where('status', 'menunggu')->count(),
            'diterima' => $donasi->where('status', 'diterima')->count(),
        ];

        return view('Dashboard.Donatur', compact('donasi', 'statusCount'));
    }

    /**
     * Simpan donasi buku baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'kondisi' => 'nullable|string',
            'jumlah' => 'required|integer|min:1',
            'foto' => 'nullable|image|max:2048',
            'tanggal' => 'nullable|date',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('donasi', 'public');
        }

        Donasi::create([
            'idDonatur' => session('idDonatur'), // ✅ sesuai struktur tabel
            'judul_buku' => $request->judul,
            'kategori' => $request->kategori,
            'kondisi' => $request->kondisi,
            'jumlah' => $request->jumlah,
            'foto' => $fotoPath,
            'status' => 'menunggu',
            'tanggal' => $request->tanggal ?? Carbon::now(),
        ]);

        return redirect()->route('dashboard.donatur')->with('success', 'Donasi berhasil ditambahkan.');
    }
}
