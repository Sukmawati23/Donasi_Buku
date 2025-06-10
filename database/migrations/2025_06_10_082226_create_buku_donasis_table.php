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
        Schema::create('buku_donasis', function (Blueprint $table) {
            $table->unsignedBigInteger('idBuku');
            $table->unsignedBigInteger('idDonasi');
            $table->timestamps();

            // Foreign keys
            $table->foreign('idBuku')->references('idBuku')->on('bukus')->onDelete('cascade');
            $table->foreign('idDonasi')->references('idDonasi')->on('donasis')->onDelete('cascade');

            // Composite primary key
            $table->primary(['idBuku', 'idDonasi']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku_donasis');
    }
};