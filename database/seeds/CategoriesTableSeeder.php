<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class CategoriesTableSeeder
 */
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
            'slug' => 'large',
            'description' => '<p>Large flowered daylilies are defined as any flowers of 4.5" (11.5cm) diameter and above. There is no upper limit.</p><p>These are the most popular and well known category of daylilies. They come in many shapes and many colours and combinations of colour.</p>',
            'meta_description' => 'Large flowered daylilies are the most popular and well-known category of Hemerocallis; defined by a flower size of 4.5 inches and above',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('categories')->insert([
            'name' => 'Small',
            'slug' => 'small',
            'description' => '<p>Small flowered are any 3" to under 4.5" in diameter.</p><p>If you find the giants of the daylily world somewhat overwhelming or difficult to place, then you may be interested in these smaller varieties. Since they were officially recognised as a seperate class, these plants have attracted increasing attention from both hybridisers and gardeners and have their own special charm.</p>',
            'meta_description' => 'Small flowered daylilies have attracted increasing attention since being officially recognised. They are defined by a flower size between 3 and 4.5 inches',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('categories')->insert([
            'name' => 'Spider',
            'slug' => 'spider',
            'description' => '<p>Spiders have long narrow flower petals. The petal length to width ratio must be 4:1 or greater.</p><p>These daylilies associate well with grasses and are becoming increasingly popular. We have put daylilies in the category of Unusual Form together with the spiders as they appear spider-like but do not have the appropriate dimensions.<br />They tend to show some twisting, curling or pinching in the flower segments which give them a sculptured, almost architectural look. These can be very interesting to use in garden design.</p>',
            'meta_description' => 'Spider daylilies here are grouped with unusual forms. They tend to have a sculptured look and can be an interesting choice in garden designs',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('categories')->insert([
            'name' => 'Miniature',
            'slug' => 'miniature',
            'description' => '<p>Miniature flowered are any under 3" in diameter.</p><p>There is a particular charm and delicacy about these little plants and what they lack in bloom size they tend to make up for with increased flower production. Ideal for any size of garden and useful when space is at a premium, they are also well suited for growing in containers. Incidentally, the term "miniature" refers only to the flower size and not the height, although they are usually in proportion.</p>',
            'meta_description' => 'Miniature flowered daylilies make up for their small bloom size (anything under 3 inches) with more flowers per plant. Ideal for where space is at a premium',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
