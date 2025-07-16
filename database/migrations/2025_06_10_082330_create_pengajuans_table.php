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
            $table->unsignedBigInteger('buku_id');
            $table->integer('jumlah');
            $table->date('tanggal');
            $table->string('status');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('idPenerima')->references('idPenerima')->on('penerimas')->onDelete('cascade');
            $table->foreign('buku_id')->references('id')->on('bukus')->onDelete('cascade');
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
