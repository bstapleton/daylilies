<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class FoliagesTableSeeder
 */
class FoliagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('foliages')->insert([
            [
                'name' => 'Evergreen'
            ],
            [
                'name' => 'Semi-evergreen'
            ],
            [
                'name' => 'Dormant'
            ]
        ]);
    }
}
