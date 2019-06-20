<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class StamenColoursTableSeeder
 */
class StamenColoursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stamen_colours')->insert([
            ['name' => 'Green', 'slug' => 'green'],
            ['name' => 'Yellow', 'slug' => 'yellow'],
            ['name' => 'Black', 'slug' => 'black']
        ]);
    }
}
