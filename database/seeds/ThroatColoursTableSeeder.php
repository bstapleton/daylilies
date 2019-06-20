<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class ThroatColoursTableSeeder
 */
class ThroatColoursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('throat_colours')->insert([
            ['name' => 'Green', 'slug' => 'green'],
            ['name' => 'Yellow', 'slug' => 'yellow'],
            ['name' => 'Gold', 'slug' => 'gold'],
            ['name' => 'Orange', 'slug' => 'orange'],
            ['name' => 'Apricot', 'slug' => 'apricot'],
            ['name' => 'Melon', 'slug' => 'melon']
        ]);
    }
}
