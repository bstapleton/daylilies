<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class FlowerColoursTableSeeder
 */
class FlowerColoursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('flower_colours')->insert([
            ['name' => 'Yellow', 'slug' => 'yellow'],
            ['name' => 'Red', 'slug' => 'red'],
            ['name' => 'Pink', 'slug' => 'pink'],
            ['name' => 'Purple', 'slug' => 'purple'],
            ['name' => 'Melon', 'slug' => 'melon'],
            ['name' => 'Cream-pink', 'slug' => 'cream-pink'],
            ['name' => 'Near-white', 'slug' => 'near-white']
        ]);
    }
}
