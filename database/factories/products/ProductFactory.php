<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      return [
            'name' => $this->faker->name(),
            'reference' => $this->faker->number(6),
            'price' => $this->faker->randomNumber(5),
            'quantity' => $this->faker->randomNumber(2)            
        ];
    }
}
