<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->text(40),
            'description' => $this->faker->text,
            'image' => $this->faker->imageUrl,
            'image_alt' => $this->faker->slug,
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }
}
