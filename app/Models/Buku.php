<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'bukus';
    protected $primaryKey = 'idBuku';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'idDonatur',
        'judul',
        'penulis',
        'kategori',
        'status_buku',
        'penerbit',
        'tahun_terbit',
        'jumlah', // jangan lupa kalau pakai jumlah juga
    ];

    /**
     * Nonaktifkan eager loading default dari User (prevent user_id error)
     */
    public function user()
    {
        return $this->belongsTo(User::class); // Paksa Laravel agar tidak menganggap ada relasi ke `user_id`
    }

    public function donatur()
    {
        return $this->belongsTo(Donatur::class, 'idDonatur', 'idDonatur');
    }
}
