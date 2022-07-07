<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Area;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::create([
            'id' => 1,
            'area' => '東京都'
        ]);

        Area::create([
            'id' => 2,
            'area' => '大阪府'
        ]);

        Area::create([
            'id' => 3,
            'area' => '福岡県'
        ]);
    }
}
