<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pendataan>
 */
class PendataanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'no_pendataan' => $this->faker->unique()->numerify('PD####'),
            'nik' => $this->faker->unique()->numerify('################'),
            'nama_lengkap' => $this->faker->name,
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'umur' => $this->faker->numberBetween(18, 80),
            'alamat' => $this->faker->address,
            'status' => 1,
        ];
    }
}
