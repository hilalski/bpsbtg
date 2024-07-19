<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserCSVSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(submenuSeeder::class);
        $this->call(SubsubmenuSeeder::class);
        //$this->call(PengadaanSeeder::class);
        //$this->call(DokumenSeeder::class);
        //$this->call(DokumenPengadaanSeeder::class);
        //$this->call(StatusPengadaanSeeder::class);
        //$this->call(PenolakanSeeder::class);
    }
}
