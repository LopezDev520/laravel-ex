<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    protected $model = OrderDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "quantity" => $this->faker->randomNumber(1, 50),
            "product_id" => Product::factory(),
            "order_id" => Order::factory(),
            "registered_by" => User::factory(),
            "subtotal" => $this->faker->randomNumber(1, 100),
        ];
    }
}
