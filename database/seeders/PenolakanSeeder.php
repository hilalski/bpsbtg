<?php

namespace Database\Seeders;

use App\Models\Penolakan;
use Illuminate\Database\Seeder;

class PenolakanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Penolakan::factory(10)->create();
    }
}
