<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class GenomesTableSeeder
 */
class GenomesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genomes')->insert([
            'name' => 'Diploid'
        ]);

        DB::table('genomes')->insert([
            'name' => 'Tetraploid'
        ]);
    }
}
