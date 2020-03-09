<?php

use Illuminate\Database\Seeder;

class PopulateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Nation', 50)->create();
        factory('App\Town', 200)->create();
        factory('App\Address', 1500)->create();
        factory('App\ProductType', 66)->create();
        factory('App\Product', 66)->create();
        factory('App\User', 500)->create();
        factory('App\CreditCard', 200)->create();
        factory('App\Order', 500)->create();
        factory('App\Invoice', 500)->create();
        factory('App\Shipment', 500)->create();
        factory('App\Review', 3000)->create();
        factory('App\OrderDetail', 4000)->create();

        foreach(range(1, 600) as $index)
        {
            DB::table('cart')->insert([
                'product_id' => rand(1,66),
                'user_id' => rand(1, 500)
            ]);
        }

        foreach(range(1, 300) as $index)
        {
            DB::table('wishlist')->insert([
                'product_id' => rand(1,66),
                'user_id' => rand(1, 500)
            ]);
        }
    }
}
