<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class SeasonPlantTableSeeder
 */
class SeasonPlantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = array_map('str_getcsv', file('plants-all.csv'));

        foreach ($csv as $row) {
            $plantId = $row[0];
            $seasons = explode(',', $row[13]);

            foreach ($seasons as $season) {
                switch ($season) {
                    case 've':
                        $seasonId = 1;
                        break;
                    case 'e':
                        $seasonId = 2;
                        break;
                    case 'm':
                        $seasonId = 3;
                        break;
                    case 'l':
                        $seasonId = 4;
                        break;
                    default:
                        $seasonId = 5;
                        break;
                }

                DB::table('season_plant')->insert([
                    [
                        'season_id' => $seasonId,
                        'plant_id' => $plantId
                    ]
                ]);
            }

        }
    }
}
