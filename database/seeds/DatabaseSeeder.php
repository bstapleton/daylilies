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
            HybridisersTableSeeder::class,
            CategoriesTableSeeder::class,
            FoliagesTableSeeder::class,
            FormsTableSeeder::class,
            GenomesTableSeeder::class,
            PlantsTableSeeder::class,
            SeasonsTableSeeder::class,
            FlowerColoursTableSeeder::class,
            ThroatColoursTableSeeder::class,
            StamenColoursTableSeeder::class,
            UsersTableSeeder::class,

            HybridiserPlantTableSeeder::class,
            SeasonPlantTableSeeder::class
        ]);
    }
}
