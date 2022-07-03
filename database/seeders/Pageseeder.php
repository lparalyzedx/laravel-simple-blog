<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Pageseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = ['Hakkımızda','Kariyer','Misyonumuz','Vizyonumuz'];
        $count = 0;
        foreach($pages as $page):
            $count++;
            DB::table('pages')->insert([
                'title' => $page,
                'slug' => Str::slug($page),
                'image' => 'https://blog.hubspot.com/hubfs/business-plan-1.jpg',
                'content' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolores adipisci recusandae sequi itaque debitis id eos voluptatem harum eveniet excepturi, inventore natus maxime fugit ad, quia consequatur facere pariatur provident.',
                'order' => $count
            ]);
        endforeach;    
    }
}
