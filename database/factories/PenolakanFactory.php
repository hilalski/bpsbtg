<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Pengadaan;
use App\Models\Penolakan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenolakanFactory extends Factory
{
    protected $model = Penolakan::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pengadaan_id' => Pengadaan::inRandomOrder()->first()->id,
            'alasan_penolakan' => $this->faker->sentence,
            'tanggal_penolakan' => $this->faker->date(),
        ];
    }
}
