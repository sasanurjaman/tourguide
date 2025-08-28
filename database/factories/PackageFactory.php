<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'package_name' => $this->faker->word(),
            'package_description' => $this->faker->sentence(),
            'package_price' => $this->faker->randomFloat(2, 100, 1000),
            'package_image' => $this->faker->imageUrl(),
        ];
    }
}
