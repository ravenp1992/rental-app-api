<?php

namespace Database\Factories;

use App\Enums\ProductStatus;
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
        $isForSale = (bool) rand(0, 1);

        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'rent_price' => rand(10, 100) * 100,
            'buy_price' => $isForSale ? (rand(500, 1000) * 100) : null,
            'deposit' => rand(500, 1000) * 100,
            'stock_quantity' => rand(1, 10),
            'status' => $this->faker->randomElement(ProductStatus::cases()),
        ];
    }
}
