<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id('idBuku');
            $table->unsignedBigInteger('idDonatur');
            $table->string('judul');
            $table->string('penulis');
            $table->string('kategori');
            $table->string('status_buku'); // contoh: baru, bekas, rusak
            $table->string('penerbit');
            $table->year('tahun_terbit');
            $table->timestamps();

            // Foreign key ke donaturs
            $table->foreign('idDonatur')->references('idDonatur')->on('donaturs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};