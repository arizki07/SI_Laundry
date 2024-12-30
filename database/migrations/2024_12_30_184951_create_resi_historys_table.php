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
        Schema::create('resi_historys', function (Blueprint $table) {
            $table->id();
            $table->string('no_cust');
            $table->string('no_resi');
            $table->string('status');
            $table->string('catatan');
            $table->string('foto_final');
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resi_historys');
    }
};
