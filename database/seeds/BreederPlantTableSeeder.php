<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Breeder;

/**
 * Class BreederPlantTableSeeder
 */
class BreederPlantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = array_map('str_getcsv', file('large.csv'));
        // todo: a) open plants csv b) get breeder_slug to get breeder id from db c) map plant id from csv and breeder id from db to the table recursively

        $dataToSeed = [];

        foreach ($csv as $row) {
            $breederSlug = $row[6];

            $breederId = Breeder::where('slug', $breederSlug)
                ->first();

            if ($breederId != null) {
                $dataToSeed[] = [
                    'breeder_id' => $breederId['id'],
                    'plant_id' => $row[0]
                ];
            }
        }

        DB::table('breeder_plant')->insert($dataToSeed);
    }
}
