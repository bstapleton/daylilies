<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Hybridiser;

/**
 * Class HybridiserPlantTableSeeder
 */
class HybridiserPlantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = array_map('str_getcsv', file('plants-all.csv'));

        $dataToSeed = [];

        foreach ($csv as $row) {
            $hybridiserSlug = $row[6];

            $hybridiser = Hybridiser::where('slug', $hybridiserSlug)
                ->first();

            if ($row[2] == 'fall-guy') {
                // Special case for what is listed as Adams-Adams because obviously there's one like that.
                $dataToSeed[] = [
                    'hybridiser_id' => 1,
                    'plant_id' => 196
                ];
                $dataToSeed[] = [
                    'hybridiser_id' => 2,
                    'plant_id' => 196
                ];
            } elseif ($hybridiser != null) {
                // Standard insert of 1:m hybridiser:plant
                $dataToSeed[] = [
                    'hybridiser_id' => $hybridiser['id'],
                    'plant_id' => $row[0]
                ];
            } else {
                // Catching all the m:m hybridiser:plant
                if (strstr($hybridiserSlug, '-')) {
                    $tupleBreeders = explode('-', $hybridiserSlug);

                    foreach ($tupleBreeders as $normalisedBreeder) {
                        $hybridiser = Hybridiser::where('slug', strtolower($normalisedBreeder))
                            ->first();

                        if ($hybridiser != null) {
                            $dataToSeed[] = [
                                'hybridiser_id' => $hybridiser['id'],
                                'plant_id' => $row[0]
                            ];
                        }
                    }
                }
            }
        }

        DB::table('hybridiser_plant')->insert($dataToSeed);
    }
}
