<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('forms')->insert([
            [
                'name' => 'Single'
            ],
            [
                'name' => 'Double'
            ],
            [
                'name' => 'Spider'
            ],
            [
                'name' => 'Unusual form'
            ],
            [
                'name' => 'Polymerous'
            ]
        ]);
    }
}
