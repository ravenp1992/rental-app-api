<?php

namespace Database\Factories;

use Domains\Category\Models\Category;
use Domains\Product\Enums\ProductStatus;
use Domains\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isForSale = (bool) rand(0, 1);

        return [
            'category_id' => Category::factory(),
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
