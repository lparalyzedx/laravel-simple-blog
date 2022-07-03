<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Categoryseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = ['Saglık','Sosyal','Kodlama','Günlük Yaşam'];
        foreach($categories as $category){
            DB::table('categories')->insert([
             'name' => $category,
             'slag' => Str::slug($category,'-'),
            ]);
        }
    }
}
