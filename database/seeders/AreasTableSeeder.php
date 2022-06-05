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
            'area' => '東京都'
        ]);

        Area::create([
            'area' => '大阪府'
        ]);

        Area::create([
            'area' => '福岡県'
        ]);
    }
}
