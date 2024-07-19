<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Dokumen;
use App\Models\Pengadaan;
use Illuminate\Database\Eloquent\Factories\Factory;

class DokumenFactory extends Factory
{
    protected $model = Dokumen::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pengadaan_id' => Pengadaan::factory(),
        ];
    }
}
