<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'brand_id' => rand(1, 5),
            'sku' => $this->faker->unique()->word(),
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->text(rand(90, 110)),
            'quantity' => rand(3, 20),
            'weight' => 0.90,
            'price' => rand(199, 999),
            'status' => rand(0, 1),
            'featured' => rand(0, 1)
        ];
    }
}
