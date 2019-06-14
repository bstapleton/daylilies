<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThroatColourPlantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('throat_colour_plant', function (Blueprint $table) {
            $table->unsignedInteger('throat_colour_id');
            $table->unsignedInteger('plant_id');
            $table->primary(['throat_colour_id', 'plant_id']);
            $table->foreign('throat_colour_id')->references('id')->on('throat_colours')->onDelete('cascade');
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
        Schema::dropIfExists('throat_colour_plant');
    }
}
