<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $idDonatur = session('idDonatur');
        $cari = $request->input('search');

        $bukus = Buku::where('idDonatur', $idDonatur)
            ->when($cari, function ($query, $cari) {
                return $query->where('judul', 'like', "%{$cari}%");
            })->get();

        return view('dashboard.daftar_buku', compact('bukus'));
    }

    public function create()
    {
        return view('dashboard.tambah_buku');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'jumlah' => 'required|integer|min:1',
            'penulis' => 'nullable|string|max:255',
            'status_buku' => 'nullable|string|max:100',
            'penerbit' => 'nullable|string|max:255',
            'tahun_terbit' => 'nullable|integer|min:1000|max:' . date('Y'),
        ]);

        Buku::create([
            'idDonatur' => session('idDonatur'),
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'jumlah' => $request->jumlah,
            'penulis' => $request->penulis,
            'status_buku' => $request->status_buku,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
        ]);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $buku = Buku::where('idBuku', $id)
                    ->where('idDonatur', session('idDonatur'))
                    ->firstOrFail();

        return view('dashboard.edit_buku', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'jumlah' => 'required|integer|min:1',
        ]);

        $buku = Buku::where('idBuku', $id)
                    ->where('idDonatur', session('idDonatur'))
                    ->firstOrFail();

        $buku->update($request->all());

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $buku = Buku::where('idBuku', $id)
                    ->where('idDonatur', session('idDonatur'))
                    ->firstOrFail();

        $buku->delete();

        return back()->with('success', 'Buku berhasil dihapus.');
    }
}
