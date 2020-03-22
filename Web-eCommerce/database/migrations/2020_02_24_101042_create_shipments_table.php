<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tracking_number',15)->nullable();
            $table->date('delivery_date')->nullable();
            
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('address_id');
            $table->unsignedBigInteger('carrier_id')->nullable();
            $table->unsignedBigInteger('delivery_status_id')->default(1); // viene fissato a pending
            
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
        Schema::dropIfExists('shipments');
    }
}
