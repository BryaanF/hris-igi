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
        Schema::create('pengajuan_cuti', function (Blueprint $table) {
            $table->id('id_pengajuan_cuti');
            $table->string('mulai_cuti');
            $table->string('selesai_cuti');
            $table->integer('disetujui');
            $table->foreignId('data_karyawan_id')->constrained('data_karyawan', 'id_data_karyawan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuancuti');
    }
};