<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Cek apakah admin sudah ada
        if (!User::where('email', 'admin@donasibuku.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'kode_user' => 'ADM001',
                'email' => 'admin@donasibuku.com',
                'password' => Hash::make('GTI_ERROR'), // Ganti ke password yang benar
                'role' => 'admin',
                'tipe_akun' => 'admin',
                'alamat' => 'Pusat Donasi Buku',
                'telepon' => '0895404587176',
                'email_verified_at' => now(),
            ]);
        }
    }
}