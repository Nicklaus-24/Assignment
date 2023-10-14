<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ChatRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('chat_rooms')->insert([
            'firstname' =>'General',
            'lastname'=> 'Pompei',

        ]);

        DB::table('chat_rooms')->insert([
            'firstname'=>' Tech',
            'lastname'=>'Talk'
        ]);
    }
}
