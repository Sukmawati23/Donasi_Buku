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
        Schema::create('menyumbangs', function (Blueprint $table) {
            $table->id('idMenyumbang');
            $table->unsignedBigInteger('idDonatur');
            $table->integer('jumlah');
            $table->date('tanggal');
            $table->string('status');
            $table->timestamps();

            // Foreign key
            $table->foreign('idDonatur')->references('idDonatur')->on('donaturs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menyumbangs');
    }
};