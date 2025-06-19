<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Donatur extends Authenticatable
{
    use HasFactory, Notifiable;

    // Menentukan nama tabel (opsional jika nama model ≠ nama tabel)
    protected $table = 'donaturs';

    // Primary key custom
    protected $primaryKey = 'idDonatur';

    // Jika primary key bukan 'id', set $incrementing dan $keyType
    public $incrementing = true;
    protected $keyType = 'int';

    // Kolom yang boleh diisi
    protected $fillable = [
        'nama',
        'email',
        'password',
        'noTelepon',
        'alamat',
    ];

    // Tabel memiliki timestamps
    public $timestamps = true;

    /**
     * Relasi: Donatur memiliki banyak Buku
     */
public function bukus()
{
    return $this->hasMany(\App\Models\Buku::class, 'idDonatur', 'idDonatur');
}


}
