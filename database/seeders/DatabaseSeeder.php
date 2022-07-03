<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Categoryseed::class);
        $this->call(Articlesseeder::class);
        $this->call(Pageseeder::class);
        $this->call(Userseeder::class);
        $this->call(ConfigSeeder::class);
    }
}
