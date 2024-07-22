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
        $csvFile = fopen(base_path('database/seeders/data/csv/data.csv'), 'r');

        // Skip the header row
        fgetcsv($csvFile);

        // Iterate over each row of the file
        while (($row = fgetcsv($csvFile, 0, ';')) !== FALSE) {
            // Insert data into the database
            User::insert([
                'id' => $row[0],
                'name' => $row[1],
                'nip' => $row[2],
                'email' => $row[3],
                'phone_number' => $row[4],
                'unit' => $row[5],
                'gaji' => $row[6],
                'role' => $row[7],
                'password' => bcrypt($row[8]),
                'is_kepala_unit' => $row[9],
                'is_tim_keuangan' => $row[10],
                'is_unit' => $row[11],
                'is_operator' => $row[12],
                'is_pbj' => $row[13],
                'is_ppk' => $row[14],
                'is_admin' => $row[15],
                'status' => $row[16]
            ]);
        }

        // Close the file
        fclose($csvFile);
    }
}
