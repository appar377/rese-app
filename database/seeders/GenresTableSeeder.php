<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $param = new Genre([
            'genre' => '寿司'
        ]);
        $param->save();

        $param = new Genre([
            'genre' => '焼肉'
        ]);
        $param->save();

        $param = new Genre([
            'genre' => '居酒屋'
        ]);
        $param->save();

        $param = new Genre([
            'genre' => 'イタリアン'
        ]);
        $param->save();

        $param = new Genre([
            'genre' => 'ラーメン'
        ]);
        $param->save();
    }
}
