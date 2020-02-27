<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([ RolesTableSeeder::class ]);

        $admin = [
            'id' => 1, 
            'user_role_id' => '2', 
            'degree_id' => NULL,
            'name' => 'admin', 
            'surname' => 'admin', 
            'matric_no' => '0',
            'email' => 'admin@gmail.com', 
            'password' => 'admin', 
            'personal_calendar' => FALSE,
            'LAU' => now()
        ];

        DB::table('users')->insert($admin);

        $this->call([ PopulateSeeder::class ]);
    }
}
