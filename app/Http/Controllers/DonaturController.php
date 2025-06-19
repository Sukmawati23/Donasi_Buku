<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use Illuminate\Support\Carbon;

class DonaturController extends Controller
{
  public function index()
{
    $donaturId = session('idDonatur');

    $donasi = Donasi::where('idDonatur', $donaturId)->get(); // ✅ Tambahkan ini
    $statusCount = [
        'menunggu' => $donasi->where('status', 'Menunggu')->count(),
        'diterima' => $donasi->where('status', 'Diterima')->count(),
    ];

    return view('Dashboard.Donatur', compact('donasi', 'statusCount'));
}


    public function store(Request $request)
    {
        $request->validate([
            'judul_buku' => 'required|string|max:255',
            'kategori' => 'required|string',
            'kondisi' => 'required|string',
            'jumlah' => 'required|integer|min:1', 
            'foto' => 'nullable|image|max:2048',
            'tanggal' => 'nullable|date',
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('donasi', 'public');
        }

        Donasi::create([
            'idDonatur' => session('idDonatur'),
            'judul_buku' => $request->judul_buku,
            'kategori' => $request->kategori,
            'kondisi' => $request->kondisi,
            'jumlah' => $request->jumlah,
            'foto' => $path,
            'status' => 'Menunggu',
            'tanggal' => $request->tanggal ?? Carbon::now(),
        ]);

        return redirect()->route('dashboard.donatur')->with('success', 'Donasi berhasil ditambahkan.');
    }
}
