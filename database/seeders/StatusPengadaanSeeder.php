<?php

namespace Database\Seeders;

use App\Models\StatusPengadaan;
use Illuminate\Database\Seeder;

class StatusPengadaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusPengadaan::factory(20)->create();
    }
}
