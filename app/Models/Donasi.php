<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Donasi extends Model
{
    use HasFactory;

    protected $table = 'donasis';

    protected $fillable = [
        'idDonatur',     
        'judul_buku',
        'kategori',
        'kondisi',
        'foto',
        'status',
        'jumlah',         
        'tanggal',        
    ];

    // Relasi ke model Donatur
    public function donatur()
    {
        return $this->belongsTo(Donatur::class, 'idDonatur', 'idDonatur');
    }

    // Akses foto
    public function getFotoUrlAttribute()
    {
        return $this->foto ? Storage::url($this->foto) : null;
    }
}
