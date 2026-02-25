<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Color>
 */
class ColorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $colors = [
            'Black' => '#000000',
            'White' => '#FFFFFF',
            'Oak' => '#D4A574',
            'Walnut' => '#5C4033',
            'Grey' => '#808080',
            'Beige' => '#F5F5DC',
        ];
    
        $name = fake()->unique()->randomElement(array_keys($colors));
        
        return [
            'name' => $name,
            'hex_code' => $colors[$name],
        ];
    }
}
