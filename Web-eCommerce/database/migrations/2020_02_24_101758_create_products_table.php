<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('payment',9,3);
            $table->tinyInteger('sale'); // you have to give the % of sale
            $table->mediumInteger('stock');
            $table->mediumInteger('buy_counter'); // for statistic purpose
            $table->boolean('available'); // 1 for true
            $table->text('info');

            $table->unsignedBigInteger('product_type_id');
            $table->unsignedBigInteger('iva_category_id')->nullable();
            
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
        Schema::dropIfExists('products');
    }
}
