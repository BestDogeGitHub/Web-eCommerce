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
            $table->decimal('payment',9,3); // without sale
            $table->tinyInteger('sale')->default(0); // you have to give the % of sale
            $table->mediumInteger('stock')->default(0);
            $table->mediumInteger('buy_counter')->default(0); // for statistic purpose
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
