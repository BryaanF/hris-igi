<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            'username' => 'administrator_master',
            'email' => 'admin@indoglobalimpex.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin@igi'),
            'role' => 'Administrator',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'username' => 'employee_example',
            'email' => 'employee@indoglobalimpex.com',
            'email_verified_at' => now(),
            'password' => bcrypt('employee@igi'),
            'role' => 'Employee',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]]);

    }
}
