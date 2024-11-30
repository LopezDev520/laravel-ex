<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "date" => $this->faker->date,
            "total" => $this->faker->randomNumber(1, 1000),
            "route" => $this->faker->address,
            "status" => $this->faker->randomElement([1, 0]),
            "registered_by" => User::factory(),
            "client_id" => Client::factory(),
            "created_at" => now(),
            "updated_at" => now()
        ];
    }
}
