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
        Schema::create('gaji', function (Blueprint $table) {
            $table->id('id_gaji');
            $table->integer('gaji_pokok');
            $table->integer('potongan');
            $table->integer('tunjangan');
            $table->integer('total_gaji');
            $table->date('tanggal_digaji');
            $table->foreignId('data_karyawan_id')->constrained('data_karyawan', 'id_data_karyawan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaji');
    }
};
