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

        $dataToSeed = [];

        foreach ($csv as $row) {
            $breederSlug = $row[6];

            $breeder = Breeder::where('slug', $breederSlug)
                ->first();

            if ($row[0] == 197) {
                // Special case for what is listed as Adams-Adams because obviously there's one like that.
                $dataToSeed[] = [
                    'breeder_id' => 1,
                    'plant_id' => 197
                ];
                $dataToSeed[] = [
                    'breeder_id' => 2,
                    'plant_id' => 197
                ];
            } elseif ($breeder != null) {
                // Standard insert of 1:m breeder:plant
                $dataToSeed[] = [
                    'breeder_id' => $breeder['id'],
                    'plant_id' => $row[0]
                ];
            } else {
                // Catching all the m:m breeder:plant
                if (strstr($breederSlug, '-')) {
                    $tupleBreeders = explode('-', $breederSlug);

                    foreach ($tupleBreeders as $normalisedBreeder) {
                        $breeder = Breeder::where('slug', strtolower($normalisedBreeder))
                            ->first();

                        if ($breeder != null) {
                            $dataToSeed[] = [
                                'breeder_id' => $breeder['id'],
                                'plant_id' => $row[0]
                            ];
                        }
                    }
                }
            }
        }

        DB::table('breeder_plant')->insert($dataToSeed);
    }
}
