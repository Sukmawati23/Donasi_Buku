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
       Schema::table('donasis', function (Blueprint $table) {
        $table->date('tanggal')->nullable()->after('jumlah'); // pastikan 'jumlah' ada, atau sesuaikan urutannya
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donasis', function (Blueprint $table) {
        $table->dropColumn('tanggal');
    });
    }
};
