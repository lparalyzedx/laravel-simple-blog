<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
          'name' => 'Cafer Güvenç',
          'email' => 'caferguvenc@gmail.com',
          'image' => 'https://bestigcaptions.com/wp-content/uploads/2022/02/Sad-Profile-Whatsapp-DP.jpg',
          'admin' => 1,
          'password' => bcrypt('0852can')
         ]);

         DB::table('users')->insert([
            'name' => 'Serhat Güvenç',
            'email' => 'serhatg@gmail.com',
            'image' => 'https://bestigcaptions.com/wp-content/uploads/2022/02/Sad-Profile-Whatsapp-DP.jpg',
            'admin' => 0,
            'password' => bcrypt('0852serhat')
         ]);
    }
}
