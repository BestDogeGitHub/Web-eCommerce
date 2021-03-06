<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table0) {
            $table0->foreign('address_id')->references('id')
            ->on('addresses')->onDelete('cascade'); });

        Schema::table('credit_cards', function(Blueprint $table1) {
            $table1->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade'); });

        Schema::table('credit_cards', function(Blueprint $tablex) {
            $tablex->foreign('credit_card_company_id')->references('id')
            ->on('credit_card_companies')->onDelete('cascade'); });

        Schema::table('towns', function(Blueprint $table2) {
            $table2->foreign('nation_id')->references('id')
            ->on('nations')->onDelete('cascade'); });

        Schema::table('product_images', function(Blueprint $table3) {
            $table3->foreign('product_id')->references('id')
            ->on('products')->onDelete('cascade'); });

        Schema::table('addresses', function(Blueprint $table4) {
            $table4->foreign('town_id')->references('id')
            ->on('towns')->onDelete('cascade'); });

        Schema::table('shipments', function(Blueprint $table5) {
            $table5->foreign('carrier_id')->references('id')
            ->on('carriers')->onDelete('cascade'); });

        Schema::table('shipments', function(Blueprint $table6) {
            $table6->foreign('delivery_status_id')->references('id')
            ->on('delivery_statuses')->onDelete('cascade'); });

        Schema::table('invoices', function(Blueprint $table7) {
            $table7->foreign('order_id')->references('id')
            ->on('orders')->onDelete('cascade'); });


        Schema::table('invoices', function(Blueprint $table666) {
            $table666->foreign('credit_card_id')->references('id')
            ->on('credit_cards')->onDelete('cascade'); });

        Schema::table('shipments', function(Blueprint $table8) {
            $table8->foreign('order_id')->references('id')
            ->on('orders')->onDelete('cascade'); });

        Schema::table('orders', function(Blueprint $table9) {
            $table9->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade'); });

        Schema::table('reviews', function(Blueprint $table10) {
            $table10->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade'); });

        Schema::table('reviews', function(Blueprint $table11) {
            $table11->foreign('product_id')->references('id')
            ->on('products')->onDelete('cascade'); });

        Schema::table('shipments', function(Blueprint $table12) {
            $table12->foreign('address_id')->references('id')
            ->on('addresses')->onDelete('cascade'); });

        Schema::table('invoices', function(Blueprint $table13) {
            $table13->foreign('payment_method_id')->references('id')
            ->on('payment_methods')->onDelete('cascade'); });

        Schema::table('order_details', function(Blueprint $table14) {
            $table14->foreign('order_id')->references('id')
            ->on('orders')->onDelete('cascade'); });

        Schema::table('order_details', function(Blueprint $table15) {
            $table15->foreign('product_id')->references('id')
            ->on('products')->onDelete('cascade'); });

        Schema::table('products', function(Blueprint $table16) {
            $table16->foreign('product_type_id')->references('id')
            ->on('product_types')->onDelete('cascade'); });

        Schema::table('products', function(Blueprint $table166) {
            $table166->foreign('iva_category_id')->references('id')
            ->on('iva_categories')->onDelete('cascade'); });

        Schema::table('values', function(Blueprint $table17) {
            $table17->foreign('attribute_id')->references('id')
            ->on('attributes')->onDelete('cascade'); });

        Schema::table('product_types', function(Blueprint $table18) {
            $table18->foreign('producer_id')->references('id')
            ->on('producers')->onDelete('cascade'); }); 

        Schema::table('site_images', function(Blueprint $table20) {
            $table20->foreign('site_image_role_id')->references('id')
            ->on('site_image_roles')->onDelete('cascade'); }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table0->dropForeign(['address_id']);
        $table1->dropForeign(['user_id']);
        $tablex->dropForeign(['credit_card_company_id']);
        $table2->dropForeign(['nation_id']);
        $table3->dropForeign(['product_id']);
        $table4->dropForeign(['town_id']);
        $table5->dropForeign(['carrier_id']);
        $table6->dropForeign(['delivery_status_id']);
        $table7->dropForeign(['order_id']);
        $table666->dropForeign(['credit_card_id']);
        $table8->dropForeign(['order_id']);
        $table9->dropForeign(['user_id']);
        $table10->dropForeign(['user_id']);
        $table11->dropForeign(['product_type_id']);
        $table12->dropForeign(['address_id']);
        $table13->dropForeign(['payment_method_id']);
        $table14->dropForeign(['order_id']);
        $table15->dropForeign(['product_id']);
        $table16->dropForeign(['product_type_id']);
        $table17->dropForeign(['attribute_id']);
        $table18->dropForeign(['producer_id']);
        $table20->dropForeign(['site_image_role_id']);
    }
}
