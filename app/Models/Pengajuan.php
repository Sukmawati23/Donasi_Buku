<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Buku;
use App\Models\User;
use App\Models\Penerima;




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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}