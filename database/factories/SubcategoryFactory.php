<?php

namespace Database\Factories;

use Domains\Category\Models\Category;
use Domains\Subcategory\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubcategoryFactory extends Factory
{
    protected $model = Subcategory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid,
            'category_id' => Category::factory(),
            'name' => $this->faker->name,
            'is_active' => $this->faker->randomElement([1, 0]),
        ];
    }
}
