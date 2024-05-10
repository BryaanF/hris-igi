<?php

namespace Database\Factories;

use App\Models\DataKaryawan;
use App\Models\Rekrutmen;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
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
            'alamat' => fake()->address(),
            'nomor_telepon' => fake()->phoneNumber(),
            'status_karyawan' => fake()->randomElement(['Karyawan_Tetap', 'Karyawan_Kontrak']),
            'keahlian' => fake()->bs(),
            'jabatan' => fake()->jobTitle(),
            'rekrutmen_id' => Rekrutmen::factory(),
            'user_id' => User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
