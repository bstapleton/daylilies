<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateHybridiserPlantTable
 */
class CreateHybridiserPlantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hybridiser_plant', function (Blueprint $table) {
            $table->unsignedInteger('hybridiser_id');
            $table->unsignedInteger('plant_id');
            $table->primary(['hybridiser_id', 'plant_id']);
            $table->foreign('hybridiser_id')->references('id')->on('hybridisers')->onDelete('cascade');
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
