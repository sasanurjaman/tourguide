<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'article_title' => $this->faker->sentence,
            'article_slug' => $this->faker->slug,
            'article_description' => $this->faker->paragraph,
            'article_image' => $this->faker->imageUrl(640, 480, 'business', true, 'Faker'),
        ];
    }
}
