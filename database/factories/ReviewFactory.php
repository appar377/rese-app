<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'star' => $this->faker->numberBetween(1,5),
            'comment' => $this->faker->text(),
            'reserve_id' => 1,
        ];
    }
}
