<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory()->create([
            
           

            'firstname' => 'Lady',
            'email' => 'admin2@material.com',
            'staffnumber'=>'ICTA/0003',
            'password' => ('secret'),

            'firstname' => 'Idris',
            'email' => 'admin1@material.com',
            'staffnumber'=>'ICTA/0002',
            'password' => ('secret'),

            'firstname' => 'Sandra',
            'email' => 'admin@material.com',
            'staffnumber'=>'ICTA/0001',
            'password' => ('secret'),

        ]);
    }
}