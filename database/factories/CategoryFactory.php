<?php

namespace Database\Factories;

use Domains\Category\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->name;

        return [
            'uuid' => $this->faker->uuid,
            'name' => $name,
            'slug' => Str::slug($name),
            'is_active' => $this->faker->randomElement([1, 0]),
        ];
    }
}
