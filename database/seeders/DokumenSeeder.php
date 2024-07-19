<?php

namespace Database\Seeders;

use App\Models\Dokumen;
use Illuminate\Database\Seeder;

class DokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dokumen::factory(10)->create();
    }
}
