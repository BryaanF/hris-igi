<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{

    protected $guarded = [];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([[
            'name' => 'administrator',
            'email' => 'admin@admin',
            'password' => bcrypt('adminadmin'),
        ]]);

    }
}
