<?php

namespace Database\Factories;

use Domains\Category\Enums\CategoryStatus;
use Domains\Category\Models\Category;
use Domains\Category\Models\Subcategory;
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
            'status' => $this->faker->randomElement(CategoryStatus::cases()),
        ];
    }
}
