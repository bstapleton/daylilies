<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAwardPlantTable
 */
class CreateAwardPlantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('award_plant', function (Blueprint $table) {
            $table->unsignedInteger('award_id');
            $table->unsignedInteger('plant_id');
            $table->primary(['award_id', 'plant_id']);
            $table->foreign('award_id')->references('id')->on('awards')->onDelete('cascade');
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
        Schema::dropIfExists('award_plant');
    }
}
