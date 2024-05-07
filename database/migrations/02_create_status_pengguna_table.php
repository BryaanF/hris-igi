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
        Schema::create('status_pengguna', function (Blueprint $table) {
            $table->id('id_status_pengguna');
            $table->string('status'); // status pengguna bisa berupa Karyawan Tetap, Karyawan Kontrak, Ataupun Non-Karyawan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuskaryawan');
    }
};
