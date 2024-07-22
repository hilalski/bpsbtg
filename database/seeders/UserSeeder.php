<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // // Path to the SQL file
        // $sqlFile = base_path('database/seeders/data/sql/users.sql');

        // // Check if the file exists
        // if (file_exists($sqlFile)) {
        //     // Execute the SQL commands
        //     DB::unprepared(file_get_contents($sqlFile));
        // } else {
        //     // Log or handle the error appropriately
        //     echo "SQL file not found: {$sqlFile}\n";
        // }

        User::create([
            'name' => 'Muhammad Zabbar Falihin',
            'gaji' => '10000000',
            'nip' => '222112225',
            'email' => 'admin1@example.com',
            'phone_number' => '081234567890',
            'unit' => 'IPDS',
            'picture' => 'https://i.ibb.co/0jZzQYH/IMG-20201212-120751.jpg',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => 'Admin',
            'is_kepala_unit' => true,
            'is_tim_keuangan' => true,
            'is_unit' => true,
            'is_operator' => true,
            'is_pbj' => true,
            'is_ppk' => true,
            'is_admin' => true,
            'status' => 'Di Kantor',
        ]);

        User::create([
            'name' => 'Gholidho Herda Prilasakly',
            'gaji' => '10000000',
            'nip' => '222112074',
            'email' => 'admin2@example.com',
            'phone_number' => '085785529623',
            'unit' => 'Humas',
            'picture' => 'https://i.ibb.co/0jZzQYH/IMG-20201212-120751.jpg',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => 'Admin',
            'is_kepala_unit' => true,
            'is_tim_keuangan' => true,
            'is_unit' => true,
            'is_operator' => true,
            'is_pbj' => true,
            'is_ppk' => true,
            'is_admin' => true,
            'status' => 'Di Kantor',
        ]);

        // User::factory(20)->create();
    }
}
