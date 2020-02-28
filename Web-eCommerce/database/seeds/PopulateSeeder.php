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
    }
}
