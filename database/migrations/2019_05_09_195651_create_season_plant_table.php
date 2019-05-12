<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSeasonPlantTable
 */
class CreateSeasonPlantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('season_plant', function (Blueprint $table) {
            $table->unsignedInteger('season_id');
            $table->unsignedInteger('plant_id');
            $table->primary(['season_id', 'plant_id']);
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');
            $table->foreign('plant_id')->references('id')->on('plants')->onDelete('cascade');

            $table->timestamps = false;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('season_plant');
    }
}
