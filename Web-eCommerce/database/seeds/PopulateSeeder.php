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
                'product_id' => rand(1,64),
                'user_id' => rand(1, 500)
            ]);
        }
        foreach(range(1, 300) as $index)
        {
            DB::table('wishlist')->insert([
                'product_id' => rand(1,64),
                'user_id' => rand(1, 500)
            ]);
        }
        $entries = [
            [ 'category_id' => 4, 'product_type_id' => 1 ], // chitarre
            [ 'category_id' => 4, 'product_type_id' => 2 ],
            [ 'category_id' => 4, 'product_type_id' => 3 ],
            [ 'category_id' => 4, 'product_type_id' => 4 ],
            [ 'category_id' => 4, 'product_type_id' => 5 ],
            [ 'category_id' => 4, 'product_type_id' => 6 ],
            [ 'category_id' => 6, 'product_type_id' => 7 ], // tastiere
            [ 'category_id' => 6, 'product_type_id' => 8 ],
            [ 'category_id' => 6, 'product_type_id' => 9 ],
            [ 'category_id' => 6, 'product_type_id' => 10 ],
            [ 'category_id' => 6, 'product_type_id' => 11 ],
            [ 'category_id' => 6, 'product_type_id' => 12 ],
            [ 'category_id' => 7, 'product_type_id' => 13 ], //bassi
            [ 'category_id' => 7, 'product_type_id' => 14 ],
            [ 'category_id' => 7, 'product_type_id' => 15 ],
            [ 'category_id' => 5, 'product_type_id' => 16 ], //batterie
            [ 'category_id' => 5, 'product_type_id' => 17 ],
            [ 'category_id' => 5, 'product_type_id' => 18 ],
            [ 'category_id' => 5, 'product_type_id' => 19 ],
            [ 'category_id' => 5, 'product_type_id' => 20 ],
            [ 'category_id' => 5, 'product_type_id' => 21 ],
            [ 'category_id' => 20, 'product_type_id' => 22 ],// effetti chitarre
            [ 'category_id' => 20, 'product_type_id' => 23 ],
            [ 'category_id' => 20, 'product_type_id' => 24 ],
            [ 'category_id' => 20, 'product_type_id' => 25 ],
            [ 'category_id' => 20, 'product_type_id' => 26 ],
            [ 'category_id' => 20, 'product_type_id' => 27 ],
            [ 'category_id' => 14, 'product_type_id' => 28 ],// microfoni
            [ 'category_id' => 14, 'product_type_id' => 29 ],
            [ 'category_id' => 14, 'product_type_id' => 30 ],
            [ 'category_id' => 14, 'product_type_id' => 31 ],
            [ 'category_id' => 14, 'product_type_id' => 32 ],
            [ 'category_id' => 14, 'product_type_id' => 33 ],
            [ 'category_id' => 11, 'product_type_id' => 34 ],//cavi
            [ 'category_id' => 11, 'product_type_id' => 35 ],
            [ 'category_id' => 11, 'product_type_id' => 36 ],
            [ 'category_id' => 11, 'product_type_id' => 37 ],
            [ 'category_id' => 11, 'product_type_id' => 38 ],
            [ 'category_id' => 11, 'product_type_id' => 39 ],
            [ 'category_id' => 11, 'product_type_id' => 40 ],
            [ 'category_id' => 11, 'product_type_id' => 41 ],
            [ 'category_id' => 11, 'product_type_id' => 42 ],
            [ 'category_id' => 11, 'product_type_id' => 43 ],
            [ 'category_id' => 11, 'product_type_id' => 44 ],
            [ 'category_id' => 11, 'product_type_id' => 45 ],
            [ 'category_id' => 10, 'product_type_id' => 46 ],
            [ 'category_id' => 10, 'product_type_id' => 47 ],//alimentatori
            [ 'category_id' => 10, 'product_type_id' => 48 ],
            [ 'category_id' => 17, 'product_type_id' => 49 ],// casse
            [ 'category_id' => 17, 'product_type_id' => 50 ],
            [ 'category_id' => 17, 'product_type_id' => 51 ],
            [ 'category_id' => 16, 'product_type_id' => 52 ],// sub
            [ 'category_id' => 16, 'product_type_id' => 53 ],  
            [ 'category_id' => 19, 'product_type_id' => 54 ], // mixer
            [ 'category_id' => 19, 'product_type_id' => 55 ], 
            [ 'category_id' => 19, 'product_type_id' => 56 ], 
            [ 'category_id' => 19, 'product_type_id' => 57 ], 
            [ 'category_id' => 19, 'product_type_id' => 58 ], 
            [ 'category_id' => 13, 'product_type_id' => 59 ], // luci
            [ 'category_id' => 13, 'product_type_id' => 60 ], 
            [ 'category_id' => 13, 'product_type_id' => 61 ], 
            [ 'category_id' => 13, 'product_type_id' => 62 ], 
            [ 'category_id' => 13, 'product_type_id' => 63 ], 
            [ 'category_id' => 13, 'product_type_id' => 64 ], 

        ];
        foreach ($entries as $entry) {
            DB::table('category_product_type')->insert($entry);
        }
        $entries = [
            [ 'product_id' => 1, 'value_id' => 10 ], // chitarre
            [ 'product_id' => 2, 'value_id' => 10 ],
            [ 'product_id' => 3, 'value_id' => 6 ],
            [ 'product_id' => 4, 'value_id' => 10 ],
            [ 'product_id' => 5, 'value_id' => 10 ],
            [ 'product_id' => 6, 'value_id' => 6 ],
            [ 'product_id' => 7, 'value_id' => 8 ],
            [ 'product_id' => 8, 'value_id' => 6 ], // tastiere
            [ 'product_id' => 9, 'value_id' => 6 ],
            [ 'product_id' => 10, 'value_id' => 6 ],
            [ 'product_id' => 11, 'value_id' => 6 ],
            [ 'product_id' => 12, 'value_id' => 6 ],
            [ 'product_id' => 13, 'value_id' => 6 ], 
            [ 'product_id' => 14, 'value_id' => 10 ], //bassi
            [ 'product_id' => 15, 'value_id' => 10 ],
            [ 'product_id' => 16, 'value_id' => 10 ],
            [ 'product_id' => 17, 'value_id' => 8 ], //batterie
            [ 'product_id' => 18, 'value_id' => 5 ],
            [ 'product_id' => 19, 'value_id' => 6 ],
            [ 'product_id' => 20, 'value_id' => 5 ],
            [ 'product_id' => 21, 'value_id' => 8 ],
            [ 'product_id' => 22, 'value_id' => 6 ],
        ];
        foreach ($entries as $entry) {
            DB::table('product_value')->insert($entry);
        }
        $entries = [
            [ 'product_type_id' => 1, 'value_id' => 2 ], // chitarre 1
            [ 'product_type_id' => 1, 'value_id' => 11 ],
            [ 'product_type_id' => 1, 'value_id' => 23 ],
            [ 'product_type_id' => 2, 'value_id' => 2 ], // chitarre 2
            [ 'product_type_id' => 2, 'value_id' => 12 ],
            [ 'product_type_id' => 2, 'value_id' => 24 ],
            [ 'product_type_id' => 3, 'value_id' => 2 ], //chitarre 3 
            [ 'product_type_id' => 3, 'value_id' => 13 ],
            [ 'product_type_id' => 3, 'value_id' => 25 ],
            [ 'product_type_id' => 4, 'value_id' => 2 ],//chitarre 4
            [ 'product_type_id' => 4, 'value_id' => 14 ],
            [ 'product_type_id' => 4, 'value_id' => 24 ],
            [ 'product_type_id' => 5, 'value_id' => 2 ],//chitarre 5
            [ 'product_type_id' => 5, 'value_id' => 11 ],
            [ 'product_type_id' => 5, 'value_id' => 23 ],
            [ 'product_type_id' => 6, 'value_id' => 2 ],//chitarre 6
            [ 'product_type_id' => 6, 'value_id' => 3 ],
            [ 'product_type_id' => 6, 'value_id' => 25 ],
            [ 'product_type_id' => 7, 'value_id' => 15 ], // tastiere 7
            [ 'product_type_id' => 7, 'value_id' => 18 ],
            [ 'product_type_id' => 7, 'value_id' => 21 ],
            [ 'product_type_id' => 8, 'value_id' => 16 ],// tastiere 8
            [ 'product_type_id' => 8, 'value_id' => 19 ],
            [ 'product_type_id' => 8, 'value_id' => 22 ],
            [ 'product_type_id' => 9, 'value_id' => 17 ],// tastiere 9
            [ 'product_type_id' => 9, 'value_id' => 20 ],
            [ 'product_type_id' => 9, 'value_id' => 21 ],
            [ 'product_type_id' => 10, 'value_id' => 15 ],// tastiere 10
            [ 'product_type_id' => 10, 'value_id' => 18 ],
            [ 'product_type_id' => 10, 'value_id' => 21 ],
            [ 'product_type_id' => 11, 'value_id' => 16 ],// tastiere 11
            [ 'product_type_id' => 11, 'value_id' => 19 ],
            [ 'product_type_id' => 11, 'value_id' => 22 ],
            [ 'product_type_id' => 12, 'value_id' => 17 ],// tastiere 12
            [ 'product_type_id' => 12, 'value_id' => 20 ],
            [ 'product_type_id' => 12, 'value_id' => 22 ],
            [ 'product_type_id' => 13, 'value_id' => 1 ], // bassi 13
            [ 'product_type_id' => 13, 'value_id' => 11 ],
            [ 'product_type_id' => 13, 'value_id' => 23 ],
            [ 'product_type_id' => 14, 'value_id' => 1 ], // bassi 14
            [ 'product_type_id' => 14, 'value_id' => 12 ],
            [ 'product_type_id' => 14, 'value_id' => 24 ],
            [ 'product_type_id' => 15, 'value_id' => 1 ], // bassi 15
            [ 'product_type_id' => 15, 'value_id' => 12 ],
            [ 'product_type_id' => 15, 'value_id' => 24 ],
            [ 'product_type_id' => 16, 'value_id' => 26 ], // batterie 16
            [ 'product_type_id' => 16, 'value_id' => 30 ],
            [ 'product_type_id' => 17, 'value_id' => 27 ], // batterie 17 
            [ 'product_type_id' => 17, 'value_id' => 29 ],
            [ 'product_type_id' => 18, 'value_id' => 28 ], // batterie 18
            [ 'product_type_id' => 18, 'value_id' => 30 ],
            [ 'product_type_id' => 19, 'value_id' => 26 ], // batterie 19
            [ 'product_type_id' => 19, 'value_id' => 30 ],
            [ 'product_type_id' => 20, 'value_id' => 27 ], // batterie 20
            [ 'product_type_id' => 20, 'value_id' => 30 ],
            [ 'product_type_id' => 21, 'value_id' => 28 ], // batterie 21
            [ 'product_type_id' => 21, 'value_id' => 29 ],
            [ 'product_type_id' => 22, 'value_id' => 32 ], // effetti 22
            [ 'product_type_id' => 23, 'value_id' => 33 ], // effetti 23
            [ 'product_type_id' => 24, 'value_id' => 34 ], // effetti 24
            [ 'product_type_id' => 25, 'value_id' => 35 ], // effetti 25
            [ 'product_type_id' => 26, 'value_id' => 34 ], // effetti 26
            [ 'product_type_id' => 27, 'value_id' => 33 ], // effetti 27
            [ 'product_type_id' => 28, 'value_id' => 36 ], // microfoni 28
            [ 'product_type_id' => 28, 'value_id' => 38 ],
            [ 'product_type_id' => 29, 'value_id' => 37 ], // microfoni 29
            [ 'product_type_id' => 29, 'value_id' => 39 ],
            [ 'product_type_id' => 30, 'value_id' => 36 ], // microfoni 30
            [ 'product_type_id' => 30, 'value_id' => 39 ],
            [ 'product_type_id' => 31, 'value_id' => 36 ], // microfoni 31
            [ 'product_type_id' => 31, 'value_id' => 38 ],
            [ 'product_type_id' => 32, 'value_id' => 36 ], // microfoni 32
            [ 'product_type_id' => 32, 'value_id' => 38 ],
            [ 'product_type_id' => 33, 'value_id' => 37 ], // microfoni 33
            [ 'product_type_id' => 33, 'value_id' => 39 ],
            [ 'product_type_id' => 34, 'value_id' => 43 ], // Cavi 34
            [ 'product_type_id' => 34, 'value_id' => 46 ],
            [ 'product_type_id' => 35, 'value_id' => 45 ], // Cavi 35
            [ 'product_type_id' => 35, 'value_id' => 49 ],
            [ 'product_type_id' => 36, 'value_id' => 43 ], // Cavi 36
            [ 'product_type_id' => 36, 'value_id' => 49 ],
            [ 'product_type_id' => 37, 'value_id' => 44 ], // Cavi 37
            [ 'product_type_id' => 37, 'value_id' => 49 ],
            [ 'product_type_id' => 38, 'value_id' => 45 ], // Cavi 38
            [ 'product_type_id' => 38, 'value_id' => 49 ],
            [ 'product_type_id' => 39, 'value_id' => 43 ], // Cavi 39
            [ 'product_type_id' => 39, 'value_id' => 48 ],
            [ 'product_type_id' => 40, 'value_id' => 44 ], // Cavi 40
            [ 'product_type_id' => 40, 'value_id' => 47 ],
            [ 'product_type_id' => 41, 'value_id' => 45 ], // Cavi 41
            [ 'product_type_id' => 41, 'value_id' => 46 ],
            [ 'product_type_id' => 42, 'value_id' => 45 ], // Cavi 42
            [ 'product_type_id' => 42, 'value_id' => 47 ],
            [ 'product_type_id' => 43, 'value_id' => 44 ], // Cavi 43
            [ 'product_type_id' => 43, 'value_id' => 48 ],
            [ 'product_type_id' => 44, 'value_id' => 43 ], // Cavi 44
            [ 'product_type_id' => 44, 'value_id' => 49 ],
            [ 'product_type_id' => 45, 'value_id' => 43 ], // Cavi 45
            [ 'product_type_id' => 45, 'value_id' => 49 ],
            [ 'product_type_id' => 46, 'value_id' => 44 ], // Cavi 46
            [ 'product_type_id' => 46, 'value_id' => 48 ],
            [ 'product_type_id' => 47, 'value_id' => 45 ], // Cavi alimentazione 47
            [ 'product_type_id' => 47, 'value_id' => 47 ],
            [ 'product_type_id' => 48, 'value_id' => 45 ], // Cavi alimentazione 48
            [ 'product_type_id' => 48, 'value_id' => 46 ],
            [ 'product_type_id' => 49, 'value_id' => 50 ], // Casse 49
            [ 'product_type_id' => 49, 'value_id' => 54 ],
            [ 'product_type_id' => 49, 'value_id' => 56 ], 
            [ 'product_type_id' => 50, 'value_id' => 51 ], // Casse 50
            [ 'product_type_id' => 50, 'value_id' => 55 ],
            [ 'product_type_id' => 50, 'value_id' => 57 ], 
            [ 'product_type_id' => 51, 'value_id' => 52 ], // Casse 51
            [ 'product_type_id' => 51, 'value_id' => 53 ],
            [ 'product_type_id' => 51, 'value_id' => 56 ], 
            [ 'product_type_id' => 52, 'value_id' => 52 ], // Sub 52
            [ 'product_type_id' => 52, 'value_id' => 54 ],
            [ 'product_type_id' => 52, 'value_id' => 57 ], 
            [ 'product_type_id' => 53, 'value_id' => 51 ], // Sub 53
            [ 'product_type_id' => 53, 'value_id' => 55 ],
            [ 'product_type_id' => 53, 'value_id' => 56 ],
            [ 'product_type_id' => 54, 'value_id' => 58 ], // Mixer 54
            [ 'product_type_id' => 54, 'value_id' => 60 ],
            [ 'product_type_id' => 54, 'value_id' => 62 ],
            [ 'product_type_id' => 55, 'value_id' => 59 ], // Mixer 55
            [ 'product_type_id' => 55, 'value_id' => 60 ],
            [ 'product_type_id' => 55, 'value_id' => 63 ],
            [ 'product_type_id' => 56, 'value_id' => 58 ], // Mixer 56
            [ 'product_type_id' => 56, 'value_id' => 61 ],
            [ 'product_type_id' => 56, 'value_id' => 63 ],
            [ 'product_type_id' => 57, 'value_id' => 59 ], // Mixer 57
            [ 'product_type_id' => 57, 'value_id' => 61 ],
            [ 'product_type_id' => 57, 'value_id' => 63 ],
            [ 'product_type_id' => 58, 'value_id' => 58 ], // Mixer 58
            [ 'product_type_id' => 58, 'value_id' => 61 ],
            [ 'product_type_id' => 58, 'value_id' => 62 ],
            [ 'product_type_id' => 59, 'value_id' => 64 ], // Luci 59
            [ 'product_type_id' => 59, 'value_id' => 66 ],
            [ 'product_type_id' => 59, 'value_id' => 68 ],
            [ 'product_type_id' => 59, 'value_id' => 71 ],
            [ 'product_type_id' => 60, 'value_id' => 64 ], // Luci 60
            [ 'product_type_id' => 60, 'value_id' => 66 ],
            [ 'product_type_id' => 60, 'value_id' => 68 ],
            [ 'product_type_id' => 60, 'value_id' => 71 ],
            [ 'product_type_id' => 61, 'value_id' => 65 ], // Luci 61
            [ 'product_type_id' => 61, 'value_id' => 66 ],
            [ 'product_type_id' => 61, 'value_id' => 69 ],
            [ 'product_type_id' => 61, 'value_id' => 72 ],
            [ 'product_type_id' => 62, 'value_id' => 65 ], // Luci 62
            [ 'product_type_id' => 62, 'value_id' => 67 ],
            [ 'product_type_id' => 62, 'value_id' => 69 ],
            [ 'product_type_id' => 62, 'value_id' => 72 ],
            [ 'product_type_id' => 63, 'value_id' => 65 ], // Luci 63
            [ 'product_type_id' => 63, 'value_id' => 67 ],
            [ 'product_type_id' => 63, 'value_id' => 70 ],
            [ 'product_type_id' => 63, 'value_id' => 73 ],
            [ 'product_type_id' => 64, 'value_id' => 64 ], // Luci 64
            [ 'product_type_id' => 64, 'value_id' => 67 ],
            [ 'product_type_id' => 64, 'value_id' => 70 ],
            [ 'product_type_id' => 64, 'value_id' => 73 ],
            
        ];
        foreach ($entries as $entry) {
            DB::table('product_type_value')->insert($entry);
        }
    }
}
