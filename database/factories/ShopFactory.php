<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(10),
            'user_id' => 1,
            'area_id' => 1,
            'genre_id' => 1,
            'content' => $this->faker->realText(100, 2),
            'img' => UploadedFile::fake()->image('test.jpg'),
            'course' => 'Aコース',
            'price' => 5000,
        ];
    }
}
