<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $products = Product::all();
        $randomProduct = $products->random();
        $quantity = $this->faker->numberBetween(1, 10);
        return [
            'product_id' => $randomProduct->id,
            'quantity' => $quantity,
            'unit_price' => $randomProduct->price,
            'discount' => 0,
            'total' => $randomProduct->price * $quantity,
        ];
    }

    public function withOrderId(int $orderId)
    {
        return $this->state(function (array $attributes) use ($orderId) {
            return [
                'order_id' => $orderId,
            ];
        });
    }
}
