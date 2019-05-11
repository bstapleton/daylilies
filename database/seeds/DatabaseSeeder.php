<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            BreedersTableSeeder::class,
            CategoriesTableSeeder::class,
            FoliagesTableSeeder::class,
            GenomesTableSeeder::class,
            SeasonsTableSeeder::class,
            UsersTableSeeder::class
        ]);
    }
}
