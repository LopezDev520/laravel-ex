<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" =>$this->faker->name,
            "photo" => $this->randomPhoto(),
            "document" => $this->faker->unique()->numberBetween(1234567890, 2134567890),
            "address" => $this->faker->unique()->address,
            "email" => $this->faker->unique()->email,
            "phone" => $this->faker->unique()->phoneNumber,
            "registered_by" => User::factory(),
            "status" => "1",
            "created_at" => now(),
            "updated_at" => now()
        ];
    }

    public function randomPhoto()
    {
        return "dummyPhoto/" . rand(1, 15) . ".jpg"; 
    }
}
