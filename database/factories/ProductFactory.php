<?php

namespace Database\Factories;

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
            'name' => $this->faker->sentence(2),
            'price' => $this->faker->randomNumber(6, true),
            'description' => $this->faker->text,
            'sku' => $this->faker->unique()->randomNumber(6),
            'manufacturer' => $this->faker->company,
            'stock' => $this->faker->randomNumber(3),
        ];
    }

    public function withCategory(int $categoryId)
    {
        return $this->state(function (array $attributes) use ($categoryId) {
            return [
                'category_id' => $categoryId,
            ];
        });
    }
}
