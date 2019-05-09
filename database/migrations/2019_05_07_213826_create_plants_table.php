<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('name')->unique()->index();
            $table->string('slug')->unique();
            $table->integer('breeder_id')->unsigned();
            $table->integer('year_added')->nullable()->index();
            $table->integer('category_id');
            $table->integer('year_bred')->nullable();
            $table->text('description');
            $table->integer('height');
            $table->integer('flower_size');
            $table->enum('genome', ['d', 't'])->index();
            $table->enum('foliage', ['e', 's', 'd'])->index();
            $table->decimal('price', 4, 2);
            $table->boolean('in_stock')->index();
            $table->integer('quantity_in_stock');
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
