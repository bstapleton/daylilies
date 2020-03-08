<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class HybridisersTableSeeder
 */
class HybridisersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = array_map('str_getcsv', file('hybridisers.csv'));

        foreach ($csv as $row) {
            $fullName = $row[0];
            $surname = $row[1];
            $slug = $row[2];

            DB::table('hybridisers')->insert([
                [
                    'full_name' => $fullName,
                    'surname' => $surname,
                    'slug' => $slug,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);
        }
    }
}
