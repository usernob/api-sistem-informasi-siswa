<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nama" => fake()->name(),
            "alamat" => fake()->address(),
            "nomor_telepon" => fake()->phoneNumber(),
            "jenis_kelamin" => fake()->randomElement(["Laki-laki", "Perempuan"]),
        ];
    }
}
