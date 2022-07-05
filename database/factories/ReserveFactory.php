<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReserveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 3,
            'shop_id' => 1,
            'number' => $this->faker->numberBetween(1, 10),
            'date' => $this->faker->date('Y_m_d'),
            'time' => $this->faker->time('H:i:s'),
            'visited' => false,
        ];
    }
}
