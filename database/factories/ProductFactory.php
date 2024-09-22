<?php

namespace Database\Factories;

use Domains\Category\Models\Category;
use Domains\Product\Enums\ProductStatus;
use Domains\Product\Models\Product;
use Domains\User\Models\User;
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
        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'deposit' => rand(500, 1000) * 100,
            'stock_quantity' => rand(1, 10),
            'status' => ProductStatus::DRAFT->value,
            'published_at' => null,
        ];
    }
}
