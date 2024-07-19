<?php

namespace Database\Factories;

use App\Models\Pengadaan;
use App\Models\DokumenPengadaan;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatusPengadaanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pengadaan_id' => Pengadaan::inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['Diajukan', 'Diterima PPK', 'Ditolak', 'Revisi', 'Diproses', 'Dilaksanakan', 'Selesai', 'Diserahkan']),
            'changed_at' => $this->faker->dateTimeThisMonth()
        ];
    }
}
