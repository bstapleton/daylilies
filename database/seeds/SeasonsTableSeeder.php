<?php

use Illuminate\Database\Seeder;

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
