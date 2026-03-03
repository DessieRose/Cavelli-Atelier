<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $materials = [
        'Oak', 'Walnut', 'Pine', 'Steel',
        'Glass', 'Velvet', 'Linen', 'Leather', 'Rattan', 'Marble',
        ];

        return [
            'name' => fake()->unique()->randomElement($materials),
        ];
    }
}
