<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->word(),
            'name' => $this->faker->word(),
            'frontend_type' => 'select',
            'is_required' => true,
            'is_filterable' => true
        ];
    }
}
