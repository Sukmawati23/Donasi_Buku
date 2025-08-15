<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'alamat',
        'telepon',
        'role',      // ✅ penting: agar bisa menyimpan role donatur/penerima/admin
        'id_card',   // ✅ jika kamu gunakan ID Card dari form
        'is_admin'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // ✅ Konversi otomatis field tertentu jadi format yang sesuai
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
