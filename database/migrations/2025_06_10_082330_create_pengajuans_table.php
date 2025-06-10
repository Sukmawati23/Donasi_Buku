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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id('idPengajuan');
            $table->unsignedBigInteger('idPenerima');
            $table->unsignedBigInteger('idBuku'); // ditambahkan
            $table->integer('jumlah');
            $table->date('tanggal');
            $table->string('status');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('idPenerima')->references('idPenerima')->on('penerimas')->onDelete('cascade');
            $table->foreign('idBuku')->references('idBuku')->on('bukus')->onDelete('cascade'); // baru
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};