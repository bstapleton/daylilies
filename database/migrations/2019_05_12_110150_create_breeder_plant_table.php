<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreederPlantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breeder_plant', function (Blueprint $table) {
            $table->unsignedInteger('breeder_id');
            $table->unsignedInteger('plant_id');
            $table->primary(['breeder_id', 'plant_id']);
            $table->foreign('breeder_id')->references('id')->on('breeders')->onDelete('cascade');
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
        Schema::dropIfExists('breeder_plant');
    }
}
