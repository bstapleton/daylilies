<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Large',
            'description' => ''
        ]);

        DB::table('categories')->insert([
            'name' => 'Small',
            'description' => ''
        ]);

        DB::table('categories')->insert([
            'name' => 'Miniature',
            'description' => ''
        ]);

        DB::table('categories')->insert([
            'name' => 'Spider',
            'description' => ''
        ]);
    }
}
