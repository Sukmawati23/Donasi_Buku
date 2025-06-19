<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $primaryKey = 'idPengajuan'; // karena kamu tidak pakai id default "id"
    protected $table = 'pengajuans';

    protected $fillable = [
        'idPenerima',
        'idBuku',
        'jumlah',
        'tanggal',
        'status',
    ];

    public function penerima()
    {
        return $this->belongsTo(Penerima::class, 'idPenerima');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'idBuku');
    }
}
