<?php

use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 */
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
            FormsTableSeeder::class,
            GenomesTableSeeder::class,
            PlantsTableSeeder::class,
            SeasonsTableSeeder::class,
            UsersTableSeeder::class,

            BreederPlantTableSeeder::class,
            SeasonPlantTableSeeder::class
        ]);
    }
}
