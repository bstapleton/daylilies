<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStamenColourPlantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stamen_colour_plant', function (Blueprint $table) {
            $table->unsignedInteger('stamen_colour_id');
            $table->unsignedInteger('plant_id');
            $table->primary(['stamen_colour_id', 'plant_id']);
            $table->foreign('stamen_colour_id')->references('id')->on('stamen_colours')->onDelete('cascade');
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
        Schema::dropIfExists('stamen_colour_plant');
    }
}
