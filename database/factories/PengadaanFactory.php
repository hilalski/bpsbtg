<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use App\Models\Pengadaan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PengadaanFactory extends Factory
{
    protected $model = Pengadaan::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rolePPK = Role::where('name', 'PPK')->first()->id;
        $rolePBJ = Role::where('name', 'PBJ')->first()->id;
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'nama_pengadaan' => $this->faker->word,
            'tanggal_pengadaan' => $this->faker->date(),
            'penyelenggara' => $this->faker->randomElement([$rolePPK, $rolePBJ]),
        ];
    }
}
