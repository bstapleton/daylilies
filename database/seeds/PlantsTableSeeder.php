<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class PlantsTableSeeder
 */
class PlantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = array_map('str_getcsv', file('plants-all.csv'));

        foreach ($csv as $row) {
            $id = $row[0];
            $name = $row[1];
            $slug = $row[2];
            $yearAdded = $row[3];
            $categoryId = $row[4];
            $yearHybridised = $row[7];
            $description = $row[8];
            $height = $row[9];
            $flowerSize = $row[10];
            $genomeId = $row[11];
            $foliageId = $row[12];
            $price = $row[14];
            $inStock = $row[15];
            $quantityInStock = $row[16];

            DB::table('plants')->insert([
                [
                    'id' => $id,
                    'name' => $name,
                    'slug' => $slug,
                    'year_added' => $yearAdded,
                    'category_id' => $categoryId,
                    'year_hybridised' => $yearHybridised,
                    'description' => $description,
                    'height' => $height,
                    'flower_size' => $flowerSize,
                    'genome_id' => $genomeId,
                    'foliage_id' => $foliageId,
                    'price' => $price,
                    'in_stock' => $inStock,
                    'quantity_in_stock' => $quantityInStock,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);
        }
    }
}
