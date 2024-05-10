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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id('id_absensi');
            $table->date('tanggal');
            $table->string('keterangan');
            $table->enum('status_absensi', ['Masuk', 'Izin', 'Sakit', 'Alpha']);
            $table->foreignId('data_karyawan_id')->constrained('data_karyawan', 'id_data_karyawan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};