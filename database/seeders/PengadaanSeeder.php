<?php

namespace Database\Seeders;

use App\Models\Pengadaan;
use Illuminate\Database\Seeder;

class PengadaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pengadaan::factory(10)->create();
    }
}
