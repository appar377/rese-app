<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genre::create([
            'genre' => '寿司'
        ]);

        Genre::create([
            'genre' => '焼肉'
        ]);

        Genre::create([
            'genre' => '居酒屋'
        ]);

        Genre::create([
            'genre' => 'イタリアン'
        ]);

        Genre::create([
            'genre' => 'ラーメン'
        ]);
    }
}
