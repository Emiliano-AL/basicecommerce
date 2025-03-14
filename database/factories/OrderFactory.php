<?php

namespace Database\Factories;

use App\Models\Order;
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
        $users = User::all();
        return [
            'user_id' => $users->random()->id,
            'start_order_date' => $this->faker->date(),
//            'total_price' => $this->faker->randomFloat(2, 1, 100),
            'order_status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']),
        ];
    }
}
