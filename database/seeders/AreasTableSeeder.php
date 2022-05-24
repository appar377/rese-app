<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $param = new Area([
            'area' => '東京都'
        ]);
        $param->save();

        $param = new Area([
            'area' => '大阪府'
        ]);
        $param->save();

        $param = new Area([
            'area' => '福岡県'
        ]);
        $param->save();
    }
}
