<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image_ref',255);
            $table->text('image_details')->nullable();
            $table->string('link',2048)->nullable();

            $table->unsignedBigInteger('site_image_role_id')->nullable();

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
        Schema::dropIfExists('site_images');
    }
}
