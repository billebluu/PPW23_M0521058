<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => trim(preg_replace('/\s*(Dr|Dra|Ir|Prof)\.?/i', '', fake()->name())),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'tempat_lahir' => fake()->city(),
            'tgl_lahir' => fake()->date('Y-m-d', '2004-01-01'),
            'gender' => fake()->randomElement(['Male', 'Female']),
            'alamat' => fake()->address(),
            'telepon' => fake()->phoneNumber(),
            'kewarganegaraan' => fake()->country(),
            'riwayat_sekolah' => fake()->randomElement(['SMA', 'SMK', 'SMAIT', 'MA']),
            'nama_sekolah' => fake()->company(),
            'jurusan' => fake()->randomElement(['MIPA', 'IPS']),
            'tahun_lulus' => fake()->numberBetween(2023, date('Y')),
            'pasfoto' => 'path/to/pasfoto.jpg',
            'ijazah' => 'path/to/ijazah.pdf',
            'transkrip_nilai' => 'path/to/transkrip.pdf',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
