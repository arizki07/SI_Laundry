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
        Schema::create('pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->string('no_pengeluaran')->unique(); 
            $table->dateTime('tanggal_pengeluaran');
            $table->string('kategori_pengeluaran');
            $table->string('metode_pembayaran');
            $table->string('status');
            $table->double('jumlah');
            $table->string('bukti_pengeluaran')->nullable();
            $table->string('deskripsi');
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluarans');
    }
};
