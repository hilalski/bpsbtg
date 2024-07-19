<?php

namespace Database\Factories;

use App\Models\Dokumen;
use App\Models\Pengadaan;
use App\Models\DokumenPengadaan;
use Illuminate\Database\Eloquent\Factories\Factory;

class DokumenPengadaanFactory extends Factory
{
    protected $model = DokumenPengadaan::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'dokumen_id' => Dokumen::factory(),
            'harga_anggaran' => $this->faker->randomFloat(2, 100000, 2000000000),
        ];
    }
}
