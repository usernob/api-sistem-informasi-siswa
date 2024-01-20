<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmbedNilai>
 */
class EmbedNilaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nilai_latsoal_1" => fake()->numberBetween(60, 100),
            "nilai_latsoal_2" => fake()->numberBetween(60, 100),
            "nilai_latsoal_3" => fake()->numberBetween(60, 100),
            "nilai_latsoal_4" => fake()->numberBetween(60, 100),
            "nilai_uh_1" => fake()->numberBetween(60, 100),
            "nilai_uh_2" => fake()->numberBetween(60, 100),
            "nilai_uts" => fake()->numberBetween(60, 100),
            "nilai_uas" => fake()->numberBetween(60, 100),
        ];
    }
}
