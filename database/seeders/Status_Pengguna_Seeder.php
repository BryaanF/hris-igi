<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Status_Pengguna_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('status_pengguna')->insert([['status' => 'Karyawan Tetap'], ['status' => 'Karyawan Kontrak'], ['status' => 'Non Karyawan']]);

    }
}
