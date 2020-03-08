<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateHybridisersTable
 */
class CreateHybridisersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hybridisers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('surname')->index();
            $table->string('full_name')->unique();
            $table->text('biography')->nullable();

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
        Schema::dropIfExists('hybridisers');
    }
}
