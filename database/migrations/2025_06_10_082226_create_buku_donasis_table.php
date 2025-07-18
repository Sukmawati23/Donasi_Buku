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
            $table->unsignedBigInteger('buku_id');
            $table->unsignedBigInteger('donasi_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('buku_id')->references('id')->on('bukus');
            $table->foreign('donasi_id')->references('id')->on('donasis')->onDelete('cascade');

            // Composite primary key
            $table->primary(['buku_id', 'donasi_id']);
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
