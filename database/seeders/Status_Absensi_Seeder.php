<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class Status_Absensi_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('status_absensi')->insert([['tipe' => 'Masuk'], ['tipe' => 'Izin'], ['tipe' => 'Sakit'], ['tipe' => 'Alfa']]);

    }
}
