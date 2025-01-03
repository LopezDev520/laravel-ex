<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->word,
            "description" => $this->faker->sentence,
            "price" => $this->faker->randomFloat(2, 10, 1000),
            "image" => $this->faker->imageUrl(640, 480, "product", true),
            "stock" => $this->faker->numberBetween(1, 500),
            "status" => $this->faker->randomElement([1, 0]),
            "registered_by" => User::factory(),
            "created_at" => now(),
            "updated_at" => now()
        ];
    }
}
