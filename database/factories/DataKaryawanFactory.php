<?php

namespace Database\Factories;

use App\Models\DataKaryawan;
use App\Models\Rekrutmen;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DataKaryawan>
 */
class DataKaryawanFactory extends Factory
{
    // Nama asal model dari factory ini
    protected $model = DataKaryawan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'nama' => fake()->name(),
            'username' => fake()->name(),
            'password' => Hash::make('password'),
            'role_pengguna_id' => fake()->numberBetween(1, 2),
            'alamat' => fake()->address(),
            'nomor_telepon' => fake()->phoneNumber(),
            'status_pengguna_id' => fake()->numberBetween(1, 3),
            'keahlian' => fake()->bs(),
            'jabatan' => fake()->jobTitle(),
            'rekrutmen_id' => Rekrutmen::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
