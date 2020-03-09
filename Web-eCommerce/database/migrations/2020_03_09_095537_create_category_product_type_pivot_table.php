<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryProductTypePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_product_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('product_type_id')->unsigned()->index();
            $table->foreign('product_type_id')->references('id')->on('product_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_product_type');
    }
}
