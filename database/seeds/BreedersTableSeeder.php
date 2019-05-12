<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class BreedersTableSeeder
 */
class BreedersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('breeders')->insert([
            [
                'full_name' => 'Brown, E.W.',
                'slug' => 'brown-e-w',
                'surname' => 'Brown',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'full_name' => 'Adams',
                'slug' => 'adams',
                'surname' => 'Adams',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
