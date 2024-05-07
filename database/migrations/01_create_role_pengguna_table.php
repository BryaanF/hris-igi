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
        Schema::create('role_pengguna', function (Blueprint $table) {
            $table->id('id_role_pengguna');
            $table->string('role'); // Role pengguna bisa bisa berupa administrator atau karyawan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rolekaryawans');
    }
};
