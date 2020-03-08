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
            [ 'name' => 'Very early' ],
            [ 'name' => 'Early' ],
            [ 'name' => 'Mid' ],
            [ 'name' => 'Late' ],
            [ 'name' => 'Very late' ]
        ]);
    }
}
