<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Donasi extends Model
{
    use HasFactory;

    protected $table = 'donasis'; // Sesuaikan dengan nama tabel jika tidak default (yaitu 'donasis')

    protected $fillable = [
        'user_id',
        'judul_buku',
        'kategori',
        'kondisi',
        'foto',
        'status',
    ];

    /**
     * Relasi: Donasi dimiliki oleh satu User (Donatur)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Dapatkan URL foto donasi
     */
    public function getFotoUrlAttribute()
    {
        return $this->foto ? Storage::url($this->foto) : null;
    }
    public function daftarBuku()
{
    // Ambil semua donasi buku yang sudah diterima
    $donasis = Donasi::where('status', 'diterima')->get();

    return view('dashboard.daftar_buku', compact('donasis'));
}
}
