<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class SeasonsTableSeeder
 */
class SeasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seasons')->insert([
            'name' => 'Early season'
        ]);

        DB::table('seasons')->insert([
            'name' => 'Midseason'
        ]);

        DB::table('seasons')->insert([
            'name' => 'Late season'
        ]);
    }
}
