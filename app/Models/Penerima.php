<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerima extends Model
{
    use HasFactory;

    protected $table = 'penerimas';
    protected $primaryKey = 'idPenerima';
    public $timestamps = true;

    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'user_id', // kalau kamu hubungkan dengan tabel users
    ];

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class, 'idPenerima');
    }
}
