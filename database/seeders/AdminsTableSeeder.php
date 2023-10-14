<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
         Admin::factory()->create([
            'firstname' => 'Admin1',
            'email' => 'justin@gmail.com',
            'password' => Hash::make('password123')

        ]);
    }
}
