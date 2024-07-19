<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DokumenPengadaan;

class DokumenPengadaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DokumenPengadaan::factory(10)->create();
    }
}
