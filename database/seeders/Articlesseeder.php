<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\ArticlesFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Articlesseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {  
       $fak =  new  ArticlesFactory;
       $faker = $fak->definition();
        for($i=0; $i<4; $i++){
          DB::table('articles')->insert([
            'category_id' => rand(1,4),
            'title' => $faker['title'],
            'image' => $faker['image'],
            'content' => $faker['text'],
            'slug' => Str::slug($faker['title']),
          ]);
        } 
    }
}
