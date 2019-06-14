<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowerColourPlantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flower_colour_plant', function (Blueprint $table) {
            $table->unsignedInteger('flower_colour_id');
            $table->unsignedInteger('plant_id');
            $table->primary(['flower_colour_id', 'plant_id']);
            $table->foreign('flower_colour_id')->references('id')->on('flower_colours')->onDelete('cascade');
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
        Schema::dropIfExists('flower_colour_plant');
    }
}
