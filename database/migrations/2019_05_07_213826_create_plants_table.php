<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePlantsTable
 */
class CreatePlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->index();
            $table->string('slug')->unique();
            $table->smallInteger('category_id');
            $table->smallInteger('year_hybridised')->nullable();
            $table->smallInteger('year_added')->nullable()->index();
            $table->text('description')->nullable();
            $table->float('height')->nullable();
            $table->float('flower_size')->nullable();
            $table->tinyInteger('genome_id')->nullable();
            $table->tinyInteger('foliage_id')->nullable();
            $table->decimal('price', 8, 2);
            $table->boolean('in_stock')->index();
            $table->smallInteger('quantity_in_stock');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plants');
    }
}
