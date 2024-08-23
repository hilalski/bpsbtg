<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserCSVSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate the table
        User::truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Open the CSV file
        $csvFile = fopen(base_path('database/seeders/data/csv/Book2.csv'), 'r');

        // Skip the header row
        fgetcsv($csvFile);

        // Iterate over each row of the file
        while (($row = fgetcsv($csvFile, 0, ';')) !== FALSE) {
            // Insert data into the database
            User::insert([
                'id' => $row[0],
                'name' => $row[1],
                'username' => $row[2],
                'nip' => $row[3],
                'phone_number' => $row[4],
                'role' => $row[5],
                'password' => bcrypt($row[6]),
                // 'unit' => $row[5],
                // 'gaji' => $row[6],
                // 'is_kepala_unit' => $row[9],
                // 'is_tim_keuangan' => $row[10],
                // 'is_unit' => $row[11],
                'is_operator' => $row[7],
                // 'is_pbj' => $row[13],
                // 'is_ppk' => $row[14],
                // 'is_admin' => $row[8],
                'status' => $row[8]
            ]);
        }

        // Close the file
        fclose($csvFile);
    }
}
