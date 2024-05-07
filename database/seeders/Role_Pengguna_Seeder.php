<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Role_Pengguna_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role_pengguna')->insert([['role' => 'Administrator'], ['role' => 'Karyawan']]);
    }
}
