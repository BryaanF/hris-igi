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
        Schema::create('data_karyawan', function (Blueprint $table) {
            $table->id('id_data_karyawan');
            $table->string('nama');
            $table->string('username');
            $table->string('password');
            $table->foreignId('role_pengguna_id')->constrained('role_pengguna', 'id_role_pengguna');
            $table->string('alamat');
            $table->string('nomor_telepon');
            $table->foreignId('status_pengguna_id')->constrained('status_pengguna', 'id_status_pengguna');
            $table->string('keahlian');
            $table->string('jabatan');
            $table->foreignId('rekrutmen_id')->constrained('rekrutmen', 'id_rekrutmen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datakaryawan');
    }
};
