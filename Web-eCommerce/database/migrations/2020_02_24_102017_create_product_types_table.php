<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100);
            $table->string('image_ref',255);
            $table->boolean('available')->default(1); // 1 for true
            $table->integer('star_tot_number')->default(0);
            $table->mediumInteger('n_reviews')->default(0); // number of reviews, user to calculate the mean rate

            $table->unsignedBigInteger('producer_id')->nullable();

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
        Schema::dropIfExists('product_types');
    }
}