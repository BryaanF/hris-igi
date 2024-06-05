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
        Schema::create('rekrutmen', function (Blueprint $table) {
            $table->id('id_rekrutmen');
            $table->string('nama');
            $table->string('nomor_telepon');
            $table->string('alamat');
            $table->string('keahlian');
            $table->string('catatan')->nullable();
            $table->enum('status_rekrutmen', ['Proses', 'Diterima', 'Ditolak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekrutmen');
    }
};
