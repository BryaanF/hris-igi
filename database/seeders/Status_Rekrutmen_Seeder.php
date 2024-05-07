<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Status_Rekrutmen_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('status_rekrutmen')->insert([['tahapan' => 'Diterima'], ['tahapan' => 'Proses'], ['tahapan' => 'Ditolak']]);
    }
}
