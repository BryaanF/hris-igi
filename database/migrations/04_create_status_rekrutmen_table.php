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
        Schema::create('status_rekrutmen', function (Blueprint $table) {
            $table->id('id_status_rekrutmen');
            $table->string('tahapan'); // Tahapan pada status rekrutmen bisa berupa proses, diterima, ataupun ditolak

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statusrekrutmen');
    }
};
